<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 26.03.17
 * Time: 15:03
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Best move constraint
 *
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class BestMoveGuess extends Constraint
{
    /**
     * Returns the name of the class that validates this constraint.
     *
     * @return string
     */
    public function validatedBy(): string
    {
        return BestMoveGuessValidator::class;
    }
}