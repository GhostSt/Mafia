<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 11.10.17
 * Time: 21:58
 */

namespace GhostSt\CoreBundle\Form\Type\Tools\Setting;

use GhostSt\CoreBundle\Document\Tools\Setting;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerializedSettingType extends AbstractType
{
    /**
     * Player role service
     *
     * @var PlayerRoleServiceInterface
     */
    private $playerRoleService;

    /**
     * Constructor
     *
     * @param PlayerRoleServiceInterface $playerRoleService
     */
    public function __construct(PlayerRoleServiceInterface $playerRoleService)
    {
        $this->playerRoleService = $playerRoleService;
    }

    /**
     * Initializes form
     *
     * @param FormBuilderInterface $formBuilder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
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
     */
    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults([
            'allowed_options' => [],
            'empty_data'      => [],
            'data_class'      => Setting::class,
        ]);
    }
}
