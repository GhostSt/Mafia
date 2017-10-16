<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Game;

use GhostSt\CoreBundle\Document\Game\PlayerRole;
use GhostSt\CoreBundle\Document\Game\PlayerRoleInterface;
use GhostSt\CoreBundle\Repository\AbstractRepository;

/**
 * Player role repository
 */
class PlayerRoleRepository extends AbstractRepository implements PlayerRoleRepositoryInterface
{
    /**
     * Get player roles
     *
     * @return PlayerRoleInterface[]
     */
    public function all(): array
    {
        return $this->getDocumentManager()
            ->getRepository(PlayerRole::class)
            ->findAll();
    }
}
