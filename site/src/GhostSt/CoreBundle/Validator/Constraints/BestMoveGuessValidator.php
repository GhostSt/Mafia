<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 26.03.17
 * Time: 15:05
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Best move validator
 */
class BestMoveGuessValidator extends ConstraintValidator
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
        if (!is_array($value)
            || empty($value)) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.best_move_guess.invalid'))
                ->addViolation();

            return;
        }

        if (count($value) !== 3) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.best_move_guess.count'))
                ->addViolation();

            return;

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