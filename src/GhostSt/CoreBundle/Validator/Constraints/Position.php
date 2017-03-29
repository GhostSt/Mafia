<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 24.03.17
 * Time: 22:47
 */

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Position extends Constraint
{
    public $allowZero = true;

    public function validatedBy()
    {
        return PositionValidator::class;
    }
}