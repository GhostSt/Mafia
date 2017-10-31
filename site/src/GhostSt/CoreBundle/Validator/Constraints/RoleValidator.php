<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Role validator
 */
class RoleValidator extends ConstraintValidator
{
    /**
     * Translator
     *
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * Constructor
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Validates value
     *
     * @param mixed      $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (null === $value) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.role.invalid'))
                ->addViolation();
        }
    }
}