<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Game;

use GhostSt\CoreBundle\Document\UserRole;
use GhostSt\CoreBundle\Repository\AbstractRepository;

/**
 * Player role repository
 */
class PlayersRoleRepository extends AbstractRepository implements PlayerRoleRepositoryInterface
{
    /**
     * Get player roles
     *
     * @return UserRole[]
     */
    public function all()
    {
        return $this->getDocumentManager()
            ->getRepository(UserRole::class)
            ->findAll();
    }
}
