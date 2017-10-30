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
use GhostSt\CoreBundle\Filter\DateFilterInterface;

/**
 * Game repository
 */
class GameRepository extends AbstractRepository implements GameRepositoryInterface
{
    /**
     * Gets list of games
     *
     * @param DateFilterInterface $filter
     *
     * @return array
     */
    public function getList(DateFilterInterface $filter): array
    {
        $games = [];

        $qb = $this->getDocumentManager()
            ->getRepository(Game::class)
            ->createQueryBuilder();

        $qb
            ->field('date')->gte($filter->getFrom())
            ->field('date')->lt($filter->getTo());

        $query = $qb->getQuery();

        foreach ($query->execute() as $game)
        {
            $games[] = $game;
        }

        return $games;
    }
}