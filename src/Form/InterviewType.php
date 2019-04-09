<?php

namespace App\Form;

use App\Entity\Interview;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * @SuppressWarnings(PHPMD)
 */
class InterviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'interviewBy',
                TextType::class,
                [
                    'label' => 'Interview Par',
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'interviewResume',
                TextareaType::class,
                [
                'label' => 'Détails interview',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'

                ]
                ]
            )
            ->add(
                'interviewDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control'

                    ]
                ]
            )
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Interview::class,
        ]);
    }
}
