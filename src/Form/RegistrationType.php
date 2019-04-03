<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @SuppressWarnings(PHPMD)
 */
class RegistrationType extends AbstractType
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
        $builder->add('lastName')
            ->add('firstName')
            ->remove('username')
        ;
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
            'data_class' => User::class
        ]);
    }

    /**
     * Get parent form type
     * @return string FOS\UserBundle\Form\Type\RegistrationFormType
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
}
