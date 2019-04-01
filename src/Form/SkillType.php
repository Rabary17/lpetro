<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                    'label' => 'TITRE DE LA COMPETENCE',
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ])
            ->add('description', TextareaType::class, ['label' => 'DESCRIPTION',
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
}
