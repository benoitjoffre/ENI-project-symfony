<?php

namespace App\Form;



use App\Entity\Sortie;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('dateHeureDebut', DateTimeType::class, [
                'time_label' => 'Date et heure de la sortie',

                'attr' => [
                    'class' => 'form-control',
                    'type'=> 'datetime'
                ]])
            ->add('duree', NumberType::class, [
                'label' => 'Durée',
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('DateLimiteInscription', DateType::class, [
                'label' => "Durée limite d'inscription",
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('nbInscriptionsMax', NumberType::class, [
                'label' => 'Nombre de places',
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('infosSortie', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'mapped' => false,
                'choice_label' => 'nom',
                'placeholder' => "veuillez selectionner une ville",
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('enregistrer', SubmitType::class, [
                'attr' => [
                    'placeholder' => 'Enregistrer',
                    'class' => 'btn btn-primary'
                ]
            ])
            ->add('publier', SubmitType::class, [
                'attr' => [
                    'placeholder' => 'Enregistrer',
                    'class' => 'btn btn-success'
                ]
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA,
                function(FormEvent $event) {
                    $form = $event->getForm();
                    $data = $event->getData();

                    $ville = null;
                    if ($data->getLieu() !== null) {
                        $ville = $data->getLieu()->getVille();
                    }

                    $lieux = null === $ville ? [] : $ville->getLieux();
                    
                    $form->add('lieu', EntityType::class,
                        [
                            'class' => 'App\Entity\Lieu',
                            'placeholder' => 'veuillez choisir un lieu',
                            'choices' => $lieux,
                            'attr' => [
                                'class' => 'form-control'
                            ]
                        ]);
                })
            ->get('ville')->addEventListener(
                FormEvents::POST_SUBMIT,
                function(FormEvent $event) {
                    $form = $event->getForm();
                    $form->getParent()->add('lieu', EntityType::class, [
                        'class' => 'App\Entity\Lieu',
                        'placeholder' => "veuillez selectionner un lieu",
                        'choices' => $form->getData()->getLieux(),
                        'attr' => [
                            'class' => 'form-control'
                        ]
                    ]);
                    dump($form);
                }
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
