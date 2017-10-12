<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Helper;

/**
 * Role helper
 */
class RoleHelper
{
    /**
     * Gets roles view for collection type
     * @param array $roles
     *
     * @return array
     */
    public static function getCollectionTypeViewForm(array $roles)
    {
        $view = [];

        foreach ($roles as $userRole) {
            $view[$userRole->getName()] = $userRole->getId();
        }

        return $view;
    }
}
