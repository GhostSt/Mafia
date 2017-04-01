<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.03.17
 * Time: 21:37
 */

namespace GhostSt\CoreBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use GhostSt\CoreBundle\Document\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('result', CheckboxType::class, [
                'label'    => 'form.type.game.result',
                'attr'     => [
                    'class' => 'switch-input',
                ],
                'required' => true,
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
     * @param OptionsResolver @resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}