<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

use GhostSt\CoreBundle\Document\Game\PlayerRoleInterface;

/**
 * Game player interface
 */
interface GamePlayerInterface
{
    /**
     * Gets user
     *
     * @return User $user
     */
    public function getUser():? User;

    /**
     * Gets role
     *
     * @return PlayerRoleInterface $role
     */
    public function getRole():? PlayerRoleInterface;

    /**
     * Gets position
     *
     * @return int $position
     */
    public function getPosition(): int;
}
