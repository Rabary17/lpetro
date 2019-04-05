<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\TagType;
use App\Form\InterviewType;

/**
 * @SuppressWarnings(PHPMD)
 */
class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->remove('usernameCanonical')
            ->remove('email')
            ->remove('emailCanonical')
            ->remove('enabled')
            ->remove('salt')
            ->remove('password')
            ->remove('lastLogin')
            ->remove('confirmationToken')
            ->remove('passwordRequestedAt')
            ->remove('roles')
            ->remove('id')
            ->remove('lastName')
            ->remove('firstName')
            ->remove('phoneNumber')
            ->remove('dateOfBirth')
            ->remove('placeOfBirth')
            ->remove('maritalStatus')
            ->remove('conjointName')
            ->remove('nbChildren')
            ->remove('removeress')
            ->remove('seen')
            ->remove('send')
            ->remove('sendOn')
            ->remove('profileName')
            ->remove('updatedAt')
            ->remove('submit')
            ->remove('rhvalidate')
            ->remove('nationality')
            ->remove('hobbies')
            ->remove('sports')
            ->add('statut')
            ->add('tags', TagType::class)
            ->add(
                'interviews',
                CollectionType::class,
                [
                    'entry_type' => InterviewType::class,
                    'allow_add' => true,
                    'allow_delete'=> true,
                    'by_reference' => false,
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'collection-selector-user-interviews'
                    )
                ]
            )
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => User::class,
            ]
        );
    }
}
