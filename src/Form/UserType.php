<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('lastName')
            ->add('firstName')
            ->add('dateOfBirth', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('placeOfBirth')
            ->add('maritalStatus')
            ->add('conjointName')
            ->add('nbChildren')
            ->add('address')
            ->add('nationality')
            ->add('profileFile', FileType::class, [
                    'required' => false
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
