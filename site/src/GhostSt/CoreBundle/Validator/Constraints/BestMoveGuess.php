<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 26.03.17
 * Time: 15:03
 */

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class BestMoveGuess extends Constraint
{
    public function validatedBy()
    {
        return BestMoveGuessValidator::class;
    }
}