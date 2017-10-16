<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.03.17
 * Time: 21:02
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Form\Type;

use GhostSt\CoreBundle\Document\GameBestMove;
use GhostSt\CoreBundle\Helper\PositionHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Game best move type
 */
class GameBestMoveType extends AbstractType
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
            ->add('position', ChoiceType::class, [
                'label' => 'form.type.game_best_move.position',
                'choices' => PositionHelper::getPositions(1, 10)
            ])
            ->add('guess', ChoiceType::class, [
                'label' => 'form.type.game_best_move.guess',
                'multiple' => true,
                'choices' => PositionHelper::getPositions(1, 10)
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
            'data_class' => GameBestMove::class,
        ]);
    }
}