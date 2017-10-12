<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Game;

use GhostSt\CoreBundle\Document\UserRole;

/**
 * Player role repository interface
 */
interface PlayerRoleRepositoryInterface
{
    /**
     * Get player roles
     *
     * @return UserRole[]
     */
    public function all();
}
