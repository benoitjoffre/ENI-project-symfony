<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Campus;
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
            ->add('username')
            ->add('prenom')
            ->add('nom')
            ->add('tel')
            ->add('email')
            ->add('password')
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                /*'choice_label' => 'campus',*/
                'placeholder' => "veuillez selectionner un campus"
                ]
            )
            ->add('maphoto', FileType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
      
        ]);
    }
}
