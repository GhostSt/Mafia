<?php

// src/GhostSt/CoreBundle/Admin/GameAdmin.php

namespace GhostSt\CoreBundle\Admin;

use GhostSt\CoreBundle\Form\Type\GameBestMoveType;
use GhostSt\CoreBundle\Form\Type\GameDayType;
use GhostSt\CoreBundle\Form\Type\PlayerType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class GameAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form_mapper)
    {
        $form_mapper
            ->add('result', null, [

            ])
            ->add('date', 'date', [

            ])
            ->add('players', CollectionType::class, [
                'label'        => 'admin.game.form.players',
                'entry_type'   => PlayerType::class,
                'allow_add'    => true,
                'allow_delete' => true,
            ])
            ->add('days', CollectionType::class, [
                'label'        => 'admin.game.form.days',
                'entry_type'   => GameDayType::class,
                'allow_add'    => true,
                'allow_delete' => true,
            ])
            ->add('bestMove', GameBestMoveType::class, [
                'label' => 'form.type.game_day.vote',
            ]);
    }

    public function getFormTheme()
    {
        return ['GhostStCoreBundle:Admin/Game:form.html.twig'];
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid_mapper)
    {
    }

    protected function configureListFields(ListMapper $list_mapper)
    {
        $list_mapper
            ->add('date', null, [
                'label' => 'admin.game.list.date',
            ])
            ->add('result', 'boolean', [
                'label'          => 'admin.game.list.result',
                'template'       => 'GhostStCoreBundle:Admin/CRUD:list_boolean.html.twig',
                'label_type_yes' => 'test',
                'label_type_no'  => 'no1',
            ])
            ->add('_action', 'actions', [
                'label'   => 'admin.game.list.actions.edit',
                'actions' => [
                    'edit' => [
                        'template' => 'SonataAdminBundle:CRUD:list__action_edit.html.twig',
                    ],
                ],
            ]);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('edit');

        $collection
            ->add('create', 'create')
            ->add('edit', $this->getRouterIdParameter() . '/edit');
    }
}