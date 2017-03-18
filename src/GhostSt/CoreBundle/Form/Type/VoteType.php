<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.03.17
 * Time: 20:35
 */

namespace GhostSt\CoreBundle\Form\Type;

use GhostSt\CoreBundle\Helper\PositionHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
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
     * @param OptionsResolver @resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }
}