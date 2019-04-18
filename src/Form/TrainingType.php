<?php

namespace App\Form;

use App\Entity\Training;
use App\Entity\School;
use App\Entity\Filiere;
use App\Entity\TrainingResult;
use App\Entity\TrainingLevel;
use App\Form\SchoolType;
use App\Form\TrainingLevelType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

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
        $builder->add(
            'name',
            TextType::class,
            [
                    'label' => 'TITRE DE LA FORMATION',
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'description',
                null,
                [
                    'label' => 'DESCRIPTION',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'startDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'required' => false,
                    'label' => 'DEBUT DE LA FORMATION',
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'endDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'required' => false,
                    'label' => 'FIN DE LA FORMATION',
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'filiere',
                EntityType::class,
                [
                    'class' => Filiere::class,
                    'label' => 'FILIERE',
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'level',
                null,
                [
                    'class' => TrainingLevel::class,
                    'label' => 'Niveau',
                    'mapped' => true,
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'result',
                null,
                [
                    'class' => TrainingResult::class,
                    'label' => 'RESULTAT OBTENU',
                    'mapped' => true,
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'school',
                EntityType::class,
                [
                    'class' => School::class,
                    'label' => 'ETABLISSEMENT',
                    'mapped' => true,
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                if (!empty($data['newSchool']['name'])) {
                    $form->add('newSchool', SchoolType::class, array(
                        'mapped' => true,
                        'required' => false,
                        'property_path' => 'school',
                    ));
                }
            })->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();

                if (!$data) {
                    $form->add('newSchool', SchoolType::class, array(
                        'mapped' => false,
                        'required' => false,
                        'property_path' => 'school',
                    ));
                }
            });
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
        $resolver->setDefaults(
            [
            'data_class' => Training::class
            ]
        );
    }
}
