<?php

namespace GhostSt\CoreBundle\Validator\Constraints;

use GhostSt\CoreBundle\Document\User;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PlayerValidator extends ConstraintValidator
{
    /**
     * @var DataCollectorTranslator
     */
    protected $translator;

    public function __construct(DataCollectorTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function validate($value, Constraint $constraint)
    {
        if (null === $value
            || !$value instanceof User) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.player.invalid'))
                ->addViolation();
        }
    }
}