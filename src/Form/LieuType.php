<?php

namespace App\Form;

use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LieuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('rue', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('latitude', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('longitude', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
                'placeholder' => "veuillez selectionner une ville",
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
