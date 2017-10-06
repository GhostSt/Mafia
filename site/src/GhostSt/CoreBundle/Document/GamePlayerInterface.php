<?php

namespace GhostSt\CoreBundle\Document;

/**
 * Game player interface
 */
interface GamePlayerInterface
{
    /**
     * Get user
     *
     * @return User $user
     */
    public function getUser();

    /**
     * Get role
     *
     * @return UserRole $role
     */
    public function getRole();

    /**
     * Get position
     *
     * @return integer $position
     */
    public function getPosition();
}
