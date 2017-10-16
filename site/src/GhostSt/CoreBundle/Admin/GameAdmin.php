<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Admin;

use GhostSt\CoreBundle\Form\Type\GameBestMoveType;
use GhostSt\CoreBundle\Form\Type\GameDayType;
use GhostSt\CoreBundle\Form\Type\PlayerType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Game admin
 */
class GameAdmin extends AbstractAdmin
{
    /**
     * Configures form fields
     *
     * @param FormMapper $formMapperMapper
     */
    protected function configureFormFields(FormMapper $formMapperMapper)
    {
        $formMapperMapper
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

    /**
     * Configures list fields
     *
     * @param ListMapper $listMapperMapper
     */
    protected function configureListFields(ListMapper $listMapperMapper)
    {
        $listMapperMapper
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
        $collection
            ->remove('create')
            ->remove('edit');

        $collection
            ->add('create', 'create')
            ->add('edit', $this->getRouterIdParameter() . '/edit');
    }

    /**
     * Gets form theme
     */
    public function getFormTheme(): array
    {
        return ['GhostStCoreBundle:Admin/Game:form.html.twig'];
    }

    /**
     * Gets export fields
     *
     * @return array
     */
    public function getExportFields(): array
    {
        return array('id', 'result', 'date');
    }
}