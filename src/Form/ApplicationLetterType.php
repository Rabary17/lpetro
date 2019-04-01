<?php
/**
 * ApplicationLetterType class
 *
 * PHP version 7
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2012 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

namespace App\Form;

use App\Entity\ApplicationLetter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class ApplicationLetterType extends AbstractType
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
            ->add(
                'content',
                TextareaType::class, [
                    'label' => 'CONTENU',
                    'label_attr' => [
                        'class' => 'mylabel'
                    ],
                    'attr' => [
                        'class' => 'form-control ckeditor'
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
        $resolver->setDefaults(['data_class' => ApplicationLetter::class]);
    }
}
