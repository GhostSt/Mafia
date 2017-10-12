<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 08.10.17
 * Time: 20:20
 */

namespace GhostSt\CoreBundle\Admin\Tools;

use GhostSt\CoreBundle\Service\Tools\SettingServiceInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
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
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     * @param        $settingService
     */
    public function __construct(
        $code,
        $class,
        $baseControllerName,
        $settingService
    ) {
        parent::__construct($code, $class, $baseControllerName);

        $this->settingService = $settingService;
    }

    /**
     * Configures form field
     *
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('code', ChoiceType::class, [
                'label'       => 'admin.tools.setting.form.code',
                'choices'     => $this->getSettings(),
                'constraints' => [
                    new NotBlank(),
                ],
            ]);

        $form
            ->add('serialized', CheckboxType::class, [
                'label'       => 'admin.tools.setting.form.serialized',
            ]);
    }

    /**
     * Configures list fields
     *
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->add('code', null, ['label' => 'admin.tools.setting.list.code']);

        $list
            ->add('_action', 'actions', [
                'label'   => 'admin.actions',
                'actions' => [
                    'edit' => [
                        'template' => 'SonataAdminBundle:CRUD:list__action_edit.html.twig',
                    ],
                ],
            ]);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        //$collection->clearExcept(['create', 'edit', 'list']);
    }

    /**
     * Returns list of unused settings
     * @return array
     */
    private function getSettings()
    {
        $unusedSettings = $this->settingService->findUnusedSettings();
        $settings       = [];

        foreach ($unusedSettings as $setting) {
            $settings[$setting] = $setting;
        }

        return $settings;
    }
}