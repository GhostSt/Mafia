<?php

// src/GhostSt/CoreBundle/Admin/UserAdmin.php

namespace GhostSt\CoreBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form_mapper)
    {
        $form_mapper
            ->add('username', null, [
                'label' => 'admin.user.form.username'
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
        $list_mapper
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

    protected function configureRoutes(RouteCollection $collection)
    {
    }
}