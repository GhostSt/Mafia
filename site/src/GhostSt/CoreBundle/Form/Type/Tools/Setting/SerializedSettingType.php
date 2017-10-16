<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 11.10.17
 * Time: 21:58
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Form\Type\Tools\Setting;

use GhostSt\CoreBundle\Document\Tools\Setting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Serialized setting type
 */
class SerializedSettingType extends AbstractType
{
    /**
     * Initializes form
     *
     * @param FormBuilderInterface $formBuilder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options): void
    {
        $formBuilder->add('value', ChoiceType::class, [
            'attr'         => [
                'class' => 'form-control',
            ],
            'by_reference' => true,
            'choices'      => $options['allowed_options'],
            'multiple'     => true,
        ]);
    }

    /**
     * Configures default options
     *
     * @param OptionsResolver $optionsResolver
     *
     * @throws AccessException
     */
    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefaults([
            'allowed_options' => [],
            'empty_data'      => [],
            'data_class'      => Setting::class,
        ]);
    }
}
