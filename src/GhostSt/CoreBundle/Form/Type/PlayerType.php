<?php

namespace GhostSt\CoreBundle\Form\Type;

use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use GhostSt\CoreBundle\Document\GamePlayer;
use GhostSt\CoreBundle\Document\User;
use GhostSt\CoreBundle\Document\UserRole;
use GhostSt\CoreBundle\Helper\PositionHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
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
                'class' => UserRole::class
            ]);
    }

    /**
     * @param OptionsResolver @resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GamePlayer::class
        ));
    }
}
