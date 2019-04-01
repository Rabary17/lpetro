<?php

namespace App\Form;

use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * @SuppressWarnings(PHPMD)
 */
class TrainingType extends AbstractType
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
            ->add('name', TextType::class, [
                    'label' => 'TITRE DE LA FORMATION',
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add('description', null, [
                'label' => 'DESCRIPTION',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]
        );
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
            'data_class' => Training::class
        ]);
    }
}
