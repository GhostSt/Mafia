<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Form\Type;

use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use GhostSt\CoreBundle\Document\GamePlayer;
use GhostSt\CoreBundle\Document\User;
use GhostSt\CoreBundle\Document\Game\PlayerRole;
use GhostSt\CoreBundle\Helper\PositionHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Player type
 */
class PlayerType extends AbstractType
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
                'label' => 'form.type.player.position',
                'choices' => PositionHelper::getPositions(0, 10)
            ])
            ->add('user', DocumentType::class, [
                'label' => 'form.type.player.user',
                'class' => User::class
            ])
            ->add('role', DocumentType::class, [
                'label' => 'form.type.player.role',
                'class' => PlayerRole::class
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
            'data_class' => GamePlayer::class
        ));
    }
}
