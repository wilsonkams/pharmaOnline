<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Produits;
use App\Entity\Pharmacies;
use App\Form\PharmacieType;
use App\Form\ProduitType;
use App\Entity\User;
use App\Form\RegistrationFormType;

class PharmacieController extends AbstractController
{
    /**
     * @Route("/", name="pharmacie")
     */
    public function index()
    {
        return $this->render('pharmacie/index.html.twig', [
            'controller_name' => 'PharmacieController',
        ]);
    }

    /**
     * @Route("/produits/ajoutProduit", name="ajoutProduit")
     */
    public function ajoutProduit(Request $request)
    {
        $produits = new Produits();
        $form = $this->createForm(ProduitType::class, $produits);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if($produits->getImages() !== null) {
                $file = $form->get('images')->getData();
                $fileName = uniqid(). '.' .$file->guessExtension();

                try{
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }
                $produits->setImages($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($produits);
            $em->flush();

            return $this->redirectToRoute('confirmationAjoutProduit');
        }
        return $this->render('produits/ajoutProduit.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'PharmacieController',
        ]);
    }

    /**
     * @Route("/produits/confirmation", name="confirmationAjoutProduit")
     */
    public function confirmationAjoutProduit()
    {
        return $this->render('produits/confirmationAjoutProduit.html.twig', [
            'controller_name' => 'PharmacieController',
        ]);
    }

    /**
     * @Route("/pharmacie/{id}", name="inscription")
     */
    public function inscription($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findBy(['id' =>$id]);
        $pharmacie = new Pharmacies();
        $form = $this->createForm(PharmacieType::class, $pharmacie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($pharmacie);
            $em->flush();

            return $this->redirectToRoute('confirmationPharmacie', ['id' =>$pharmacie->getNomPharmacie()]);
        }

        return $this->render('pharmacie/inscriptionPharmacie.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'controller_name' => 'PharmacieController',
        ]);
    }

    /**
     * @Route("/pharmacie/confirmation/{id}/pharmacie", name="confirmationPharmacie")
     */
    public function confirmationPharmacie($id)
    {
        return $this->render('pharmacie/confirmationPharmacie.html.twig', [
            'controller_name' => 'PharmacieController',
        ]);
    }

    /**
     * @Route("/produits/afficherTousLesProduits", name="afficherTousLesProduits")
     */
    public function afficherTousLesProduits()
    {
        $produits = $this->getDoctrine()->getRepository(Produits::class)->findAll();
        return $this->render('produits/afficherTousLesProduits.html.twig', [
            'produits' => $produits,
            'controller_name' => 'PharmacieController',
        ]);
    }
}
