<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 26.03.17
 * Time: 15:05
 */

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BestMoveGuessValidator extends ConstraintValidator
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
        if (!is_array($value)
            || empty($value)) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.best_move_guess.invalid'))
                ->addViolation();

            return null;
        }

        if (count($value) !== 3) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.best_move_guess.count'))
                ->addViolation();

            return null;

        }

        foreach ($value as $item) {
            if (!is_numeric($item)
                || ($item < 1 || $item > 10)) {
                $this->context
                    ->buildViolation($this->translator->trans('validator.constraints.best_move_guess.invalid_value', ['%value%' => $item]))
                    ->addViolation();

                break;
            }
        }
    }
}