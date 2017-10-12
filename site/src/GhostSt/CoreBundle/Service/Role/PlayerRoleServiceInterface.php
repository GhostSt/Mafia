<?php

namespace GhostSt\CoreBundle\Service\Role;

use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRole;

/**
 * Player role service interface
 */
interface PlayerRoleServiceInterface
{
    /**
     * Gets roles
     *
     * @return UserRole[]
     */
    public function all();

    /**
     * Check if player is civilian
     *
     * @param GamePlayerInterface $player
     *
     * @return bool
     */
    public function isCivilian(GamePlayerInterface $player);

    /**
     * Check if player is mafia
     *
     * @param GamePlayerInterface $player
     *
     * @return bool
     */
    public function isMafia(GamePlayerInterface $player);
}
