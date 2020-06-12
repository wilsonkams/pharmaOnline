<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProduit', TextType::class, [
                'label' => 'Nom du produit ou du médicament'
            ])
            ->add('traitement', TextType::class)
            ->add('posologie', TextType::class)
            ->add('disponibilite', ChoiceType::class, [
                'choices' => [
                    'Avec Ordonnance' => 'AVEC ORDONNANCE',
                    'Sans Ordonnance' => 'SANS ORDONNANCE',
                ],
                'label' => 'Délivrance du médicament',
                'multiple' => false,
                'expanded' => false,
                'required' => false
            ])
            ->add('images', FileType::class)
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
