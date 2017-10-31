<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Role constraint
 *
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Role extends Constraint
{
    /**
     * Returns the name of the class that validates this constraint.
     *
     * @return string
     */
    public function validatedBy(): string
    {
        return RoleValidator::class;
    }
}