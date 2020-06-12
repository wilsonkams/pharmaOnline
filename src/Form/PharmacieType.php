<?php

namespace App\Form;

use App\Entity\Pharmacies;
use App\Entity\Produits;
use App\Form\ProduitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PharmacieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPharmacie', TextType::class)
            ->add('adressePharmacie', TextType::class)
            ->add('ville', ChoiceType::class, [
                'choices' => [
                    'Brazzaville' => 'BRAZZAVILLE',
                    'Pointe-Noire' => 'POINTE-NOIRE',
                    'Dolisie' => 'DOLISIE',
                    'Ouésso' => 'OUESSO',
                    'Owando' => 'OWANDO',
                    'Nkayi' => 'NKAYI',
                    'Impfondo' => 'IMPFONDO',
                    'Sibiti' => 'SIBITI',
                    'Mossendjo' => 'MOSSENDJO',
                    'Madingou' => 'MADINGOU',
                    'Gamboma' => 'GAMBOMA',
                    'Kinkala' => 'KINKALA',
                    'Djambala' => 'DJAMBALA',
                    'Mindouli' => 'MINDOULI',
                    'Djambala' => 'DJAMBALA',
                    'Makoua' => 'MAKOUA',
                    'Loudima Poste' => 'LOUDIMA POSTE',
                    'Oyo' => 'OYO',
                    'Mouyondzi' => 'MOUYONDZI', 
                ],
                'label' => 'Sélectionner la ville',
                'multiple' => false,

                'expanded' => false,
                'required' => false
            ])
            ->add('telephone', IntegerType::class)
            ->add('produit', EntityType::class, [
                'class' => Produits::class,
                'choice_label' => 'nomProduit',
                'multiple' => true,
                'expanded' => false
            ])
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pharmacies::class,
        ]);
    }
}
