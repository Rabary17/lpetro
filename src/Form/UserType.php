<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Hobby;
use App\Entity\Sport;
use App\Entity\Nationality;
use App\Form\ExtraWorkActivityType;
use App\Form\TrainingType;
use App\Form\ExperienceType;
use App\Form\SkillType;
use App\Form\LanguageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * @SuppressWarnings(PHPMD)
 */
class UserType extends AbstractType
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
        $builder->add('email')
            ->add('lastName')
            ->add('firstName')
            ->add('dateOfBirth', DateType::class, [
                    'widget' => 'single_text',
                    'required' => false
                ])
            ->add('placeOfBirth')
            ->add('maritalStatus', ChoiceType::class, [
                'choices'  => [
                    'Célibataire' => 'Célibataire',
                    'Marié(e)' => 'Marié(e)',
                    'Divorcé(e)' => 'Divorcé(e)',
                    'Veuf(ve)' => 'Veuf(ve)'
                ],
                'attr' => array(
                    'class' => 'form-control'
                )
            ])
            ->add('conjointName')
            ->add('nbChildren')
            ->add('address')
            ->add('nationality', EntityType::class, [
                    'class' => nationality::class,
                    'choice_label' => 'nationality'
                ]
            )
            ->add('phoneNumber')
            ->add('hobbies', EntityType::class, [
                    'class' => Hobby::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true
                ])
            ->add('sports', EntityType::class, [
                    'class' => Sport::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true
                ])
            ->add('extraWorkActivities', CollectionType::class, [
                    'entry_type' => ExtraWorkActivityType::class,
                    'allow_add' => true,
                    'allow_delete'=> true,
                    'by_reference' => false,
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'collection-selector-user-extraWorkActivities'
                    )
                ])
            ->add('trainings', CollectionType::class, [
                    'entry_type' => TrainingType::class,
                    'allow_add' => true,
                    'allow_delete'=> true,
                    'by_reference' => false,
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'collection-selector-user-trainings'
                    )
                ])
            ->add('languages', CollectionType::class, [
                    'entry_type' => LanguageType::class,
                    'allow_add' => true,
                    'allow_delete'=> true,
                    'by_reference' => false,
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'collection-selector-user-languages'
                    )
                ])
            ->add('experiences', CollectionType::class, [
                    'entry_type' => ExperienceType::class,
                    'allow_add' => true,
                    'allow_delete'=> true,
                    'by_reference' => false,
                    'prototype_name' => 'user_experience',
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'collection-selector-user-experience'
                    )
                ])
            ->add('skills', CollectionType::class, [
                    'entry_type' => SkillType::class,
                    'allow_add' => true,
                    'allow_delete'=> true,
                    'by_reference' => false,
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'collection-selector-user-skills'
                    )
                ])
            ->add('profileFile', FileType::class, [
                    'required' => false
                ]);
    }

    /**
     * ConfigureOptions
     *
     * @param OptionsResolver $resolver resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
