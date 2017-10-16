<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 08.10.17
 * Time: 20:20
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Admin\Tools;

use GhostSt\CoreBundle\Service\Tools\SettingServiceInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Setting admin
 */
class SettingAdmin extends AbstractAdmin
{
    /**
     * Setting service
     *
     * @var SettingServiceInterface
     */
    private $settingService;

    /**
     * Setting admin
     *
     * @param string                  $code
     * @param string                  $class
     * @param string                  $baseControllerName
     * @param SettingServiceInterface $settingService
     */
    public function __construct(
        string $code,
        string $class,
        string $baseControllerName,
        SettingServiceInterface $settingService
    ) {
        parent::__construct($code, $class, $baseControllerName);

        $this->settingService = $settingService;
    }

    /**
     * Configures form field
     *
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('code', ChoiceType::class, [
                'label'       => 'admin.tools.setting.form.code',
                'choices'     => $this->getSettings(),
                'constraints' => [
                    new NotBlank(),
                ],
            ]);

        $formMapper
            ->add('serialized', CheckboxType::class, [
                'label' => 'admin.tools.setting.form.serialized',
            ]);
    }

    /**
     * Configures list fields
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('code', null, ['label' => 'admin.tools.setting.list.code']);

        $listMapper
            ->add('_action', 'actions', [
                'label'   => 'admin.actions',
                'actions' => [
                    'edit' => [
                        'template' => 'SonataAdminBundle:CRUD:list__action_edit.html.twig',
                    ],
                ],
            ]);
    }

    /**
     * Returns list of unused settings
     *
     * @return array
     */
    private function getSettings(): array
    {
        $unusedSettings = $this->settingService->findUnusedSettings();
        $settings       = [];

        foreach ($unusedSettings as $setting) {
            $settings[$setting] = $setting;
        }

        return $settings;
    }
}