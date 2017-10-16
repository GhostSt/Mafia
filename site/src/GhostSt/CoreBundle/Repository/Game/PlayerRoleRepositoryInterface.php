<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Game;

use GhostSt\CoreBundle\Document\Game\PlayerRoleInterface;

/**
 * Player role repository interface
 */
interface PlayerRoleRepositoryInterface
{
    /**
     * Get player roles
     *
     * @return PlayerRoleInterface[]
     */
    public function all(): array;
}
