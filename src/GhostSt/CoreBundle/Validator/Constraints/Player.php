<?php

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Player extends Constraint
{
    public function validatedBy()
    {
        return PlayerValidator::class; // TODO: Change the autogenerated stub
    }
}