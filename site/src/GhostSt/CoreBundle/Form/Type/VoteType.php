<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.03.17
 * Time: 20:35
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Form\Type;

use GhostSt\CoreBundle\Helper\PositionHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Vote type
 */
class VoteType extends AbstractType
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
                'label' => 'form.type.vote.position',
                'choices' => PositionHelper::getPositions(1, 10)
            ])
            ->add('vote', ChoiceType::class, [
                'label' => 'form.type.vote.vote',
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
        $resolver->setDefaults(array(
        ));
    }
}