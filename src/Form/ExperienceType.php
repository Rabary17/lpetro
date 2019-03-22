<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('period', TextType::class, [
                'label' => 'PERIODE DU - AU',
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('position', TextType::class, [
                'label' => 'POSTE',
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('status', TextType::class, [
                'label' => 'STATUS (internat, junior, senior...)',
                'required' => false,
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'DENOMINATION DE LA SOCIETE',
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('achievements', TextareaType::class, [
                'label' => 'MISSIONS',
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('others', TextareaType::class, [
                'label' => 'AUTRES',
                'required' => false,
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
