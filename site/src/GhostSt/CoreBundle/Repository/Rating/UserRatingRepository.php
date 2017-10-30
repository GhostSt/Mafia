<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 06.10.17
 * Time: 20:54
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Rating;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ODM\MongoDB\DocumentRepository;
use GhostSt\CoreBundle\Document\UserRating;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Repository\AbstractRepository;

/**
 * User rating repository
 */
class UserRatingRepository extends AbstractRepository implements UserRatingRepositoryInterface
{
    /**
     * Return list of user ratings
     *
     * @param $gameId
     *
     * @return UserRatingInterface[]
     */
    public function getList($gameId): array
    {
        return $this->getRepository()->findBy(['gameId' => $gameId]);
    }

    /**
     * Gets list of user ratings by game id
     *
     * @param $gameId
     *
     * @return UserRatingInterface[]
     */
    public function getRatingsByGameId($gameId): array
    {
        return $this->getRepository()->findBy(['gameId' => $gameId]);
    }

    /**
     * Removes user rating
     *
     * @param UserRatingInterface $rating
     */
    public function remove(UserRatingInterface $rating): void
    {
        $this->getDocumentManager()->remove($rating);
        $this->getDocumentManager()->flush($rating);
    }

    /**
     * Saves user rating
     *
     * @param UserRatingInterface $rating
     */
    public function save(UserRatingInterface $rating): void
    {
        $this->getDocumentManager()->persist($rating);
        $this->getDocumentManager()->flush($rating);
    }

    /**
     * Return object repository
     *
     * @return DocumentRepository
     */
    private function getRepository(): DocumentRepository
    {
        return $this->getDocumentManager()->getRepository(UserRating::class);
    }

    /**
     * Removes usr ratings by game id
     *
     * @param string $gameId
     */
    public function removeRatingsByGameId(string $gameId): void
    {
        $qb = $this->getRepository()->createQueryBuilder();

        $qb
            ->remove()
            ->field('gameId')->equals($gameId)
            ->getQuery()
            ->execute();
    }
}