<?php

namespace App\Form;

use App\Entity\Experience;
use App\Form\ReferencedPersonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * @SuppressWarnings(PHPMD)
 */
class ExperienceType extends AbstractType
{
    /**
     * Formbuilder
     *
     * @param FormBuilderInterface $builder formbuilder
     * @param array                $options options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('period', TextType::class, [
                'label' => 'PERIODE DU - AU',
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])->add('position', TextType::class, [
                'label' => 'POSTE',
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])->add('status', TextType::class, [
                'label' => 'STATUS (internat, junior, senior...)',
                'required' => false,
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])->add('company', TextType::class, [
                'label' => 'DENOMINATION DE LA SOCIETE',
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])->add('achievements', TextareaType::class, [
                'label' => 'MISSIONS',
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])->add('others', TextareaType::class, [
                'label' => 'AUTRES',
                'required' => false,
                'label_attr' => [
                    'class' => 'mylabel'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])->add('referencedPeople', CollectionType::class, [
                'label' => 'Personne de référence',
                'label_attr' => [
                    'class' => 'Reference_label'
                ],
                'entry_type' => ReferencedPersonType::class,
                'allow_add' => true,
                'allow_delete'=> true,
                'by_reference' => false,
                'prototype_name' => 'personne_reference',
                'prototype' => true,
                'attr' => array(
                    'class' => 'collection-selector-people-reference'
                ),
            ]);
    }

    /**
     * configureOptions
     * @param  OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
