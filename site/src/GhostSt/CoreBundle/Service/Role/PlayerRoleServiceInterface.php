<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Role;

use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\Game\PlayerRoleInterface;

/**
 * Player role service interface
 */
interface PlayerRoleServiceInterface
{
    /**
     * Gets roles
     *
     * @return PlayerRoleInterface[]
     */
    public function all(): array;

    /**
     * Check if player is civilian
     *
     * @param GamePlayerInterface $player
     *
     * @return bool
     */
    public function isCivilian(GamePlayerInterface $player): bool;

    /**
     * Check if player is mafia
     *
     * @param GamePlayerInterface $player
     *
     * @return bool
     */
    public function isMafia(GamePlayerInterface $player): bool;
}
