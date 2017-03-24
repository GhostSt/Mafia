<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 24.03.17
 * Time: 22:48
 */

namespace GhostSt\CoreBundle\Validator\Constraint;

use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PositionValidator extends ConstraintValidator
{
    /**
     * @var DataCollectorTranslator
     */
    protected $translator;

    public function __construct(DataCollectorTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function validate($position, Constraint $constraint)
    {
        if (!is_numeric($position)) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.position.is_numeric', ['%position%' => $position ]))
                ->addViolation();
        }

        if ($position < 0
            || $position > 10
        ) {
            $this->context
                ->buildViolation($this->translator->trans('validator.constraints.position.range', ['%position%' => $position ]))

                ->addViolation();
        }
    }
}