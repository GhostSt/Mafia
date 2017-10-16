<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.03.17
 * Time: 20:24
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Form\Type;

use GhostSt\CoreBundle\Document\GameDay;
use GhostSt\CoreBundle\Helper\PositionHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Game day
 */
class GameDayType extends AbstractType
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
            ->add('left', ChoiceType::class, [
                'label' => 'form.type.game_day.left',
                'choices' => PositionHelper::getPositions(0, 10)
            ])
            ->add('killed', ChoiceType::class, [
                'label' => 'form.type.game_day.killed',
                'choices' => PositionHelper::getPositions(0, 10)
            ])
            ->add('checkDon', ChoiceType::class, [
                'label' => 'form.type.game_day.check_don',
                'choices' => PositionHelper::getPositions(0, 10)
            ])
            ->add('checkSheriff', ChoiceType::class, [
                'label' => 'form.type.game_day.check_sheriff',
                'choices' => PositionHelper::getPositions(0, 10)
            ])
            ->add('voting', CollectionType::class, [
                'label' => 'form.type.game_day.vote',
                'entry_type' => VoteType::class,
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
        $resolver->setDefaults(array(
            'data_class' => GameDay::class
        ));
    }
}