<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.03.17
 * Time: 21:37
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use GhostSt\CoreBundle\Document\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Game type
 */
class GameType extends AbstractType
{
    /**
     * Initializes form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('result', CheckboxType::class, [
                'label'    => 'form.type.game.result',
                'attr'     => [
                    'class' => 'switch-input',
                ],
                'required' => false,
            ])
            ->add('date', DateType::class, [
                'label'    => 'form.type.game.date',
                'attr'     => [
                    'class' => 'form-control',
                ],
                'required' => true,
            ])
            ->add('bestMove', GameBestMoveType::class, [
                'label' => 'form.type.game.best_move',
                'required' => true,
            ])
            ->add('players', CollectionType::class, [
                'label'        => 'form.type.game.players',
                'entry_type'   => PlayerType::class,
                'allow_add'    => true,
                'allow_delete' => true,
            ])
            ->add('days', CollectionType::class, [
                'label'        => 'form.type.game.days',
                'entry_type'   => GameDayType::class,
                'allow_add'    => true,
                'allow_delete' => true,
            ]);
    }

    /**
     * Configures form
     *
     * @param OptionsResolver $resolver
     *
     * @throws AccessException
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}