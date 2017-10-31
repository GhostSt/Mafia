<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 24.03.17
 * Time: 22:48
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Position validator
 */
class PositionValidator extends ConstraintValidator
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
        if (!is_numeric($value)) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.position.is_numeric', ['%position%' => $value ]))
                ->addViolation();
        }

        $startLimit = $constraint->allowZero ? 0 : 1;

        if ($value < $startLimit
            || $value > 10
        ) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.position.range', ['%position%' => $value, '%start_limit%' => $startLimit ]))
                ->addViolation();
        }
    }

}