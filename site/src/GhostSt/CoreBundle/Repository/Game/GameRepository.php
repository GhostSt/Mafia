<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 19.10.17
 * Time: 19:55
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Game;

use GhostSt\CoreBundle\Document\Game;
use GhostSt\CoreBundle\Repository\AbstractRepository;

/**
 * Game repository
 */
class GameRepository extends AbstractRepository implements GameRepositoryInterface
{
    /**
     * Gets list of games
     *
     * @return array
     */
    public function getList(): array
    {
        return $this->getDocumentManager()
            ->getRepository(Game::class)
            ->findAll();
    }
}