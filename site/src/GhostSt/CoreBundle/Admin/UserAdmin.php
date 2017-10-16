<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * User admin
 */
class UserAdmin extends AbstractAdmin
{
    /**
     * Configures form fields
     *
     * @param FormMapper $formMapperMapper
     */
    protected function configureFormFields(FormMapper $formMapperMapper)
    {
        $formMapperMapper
            ->add('username', null, [
                'label' => 'admin.user.form.username'
            ]);
    }

    /**
     * Configures list fields
     *
     * @param ListMapper $listMapperMapper
     */
    protected function configureListFields(ListMapper $listMapperMapper)
    {
        $listMapperMapper
            ->add('username', null, [
                'label' => 'admin.user.list.username',
            ])
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
     * Configures routes
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('delete');
    }

    /**
     * Gets export fields
     *
     * @return array
     */
    public function getExportFields(): array
    {
        return array('id', 'username', 'email', 'enabled', 'created');
    }
}