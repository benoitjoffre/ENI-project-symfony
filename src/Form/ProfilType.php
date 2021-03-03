<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Campus;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'label' => 'Pseudo',
                    'class' => 'form-control'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'label' => 'Prénom',
                    'class' => 'form-control'
                ]
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'label' => 'Nom',
                    'class' => 'form-control'
                ]
            ])
            ->add('tel', TextType::class, [
                'attr' => [
                    'label' => 'Telephone',
                    'class' => 'form-control'
                ]
            ])
            ->add('email', TextType::class,[
                'attr' => [
                    'label' => 'Email',
                    'class' => 'form-control'
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add(
                'campus',
                EntityType::class,[
                'label' => "Campus",
                'attr' => [
                    'class' => 'form-control'
                ],
                'class' => 'App:Campus',
                'choice_label' => 'nom'
            ])
            ->add('maphoto', FileType::class, [
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
      
        ]);
    }
}
