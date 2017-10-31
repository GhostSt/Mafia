<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 24.03.17
 * Time: 22:47
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Position constraint
 *
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Position extends Constraint
{
    /**
     * Allows zero value
     *
     * @var bool
     */
    public $allowZero = true;

    /**
     * Returns the name of the class that validates this constraint.
     *
     * @return string
     */
    public function validatedBy(): string
    {
        return PositionValidator::class;
    }
}