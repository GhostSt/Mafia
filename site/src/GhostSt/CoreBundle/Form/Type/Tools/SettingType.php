<?php

namespace GhostSt\CoreBundle\Form\Tools;

use GhostSt\CoreBundle\Form\Tools\Setting\CivilianRoleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingType extends AbstractType
{
    /**
     * Initializes form
     *
     * @param FormBuilderInterface $formBuilder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('civilian_roles', CivilianRoleType::class);
    }

    /**
     * Configures default options
     *
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults([
            'empty_data' => [],
        ]);
    }
}
