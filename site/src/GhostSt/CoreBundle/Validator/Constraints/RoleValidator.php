<?php

namespace GhostSt\CoreBundle\Validator\Constraints;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RoleValidator extends ConstraintValidator
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
        if (null === $value) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.role.invalid'))
                ->addViolation();
        }
    }
}