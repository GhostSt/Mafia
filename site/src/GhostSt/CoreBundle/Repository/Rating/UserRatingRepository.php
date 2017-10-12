<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 06.10.17
 * Time: 20:54
 */

namespace GhostSt\CoreBundle\Repository\Rating;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use GhostSt\CoreBundle\Document\UserRating;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Repository\AbstractRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class UserRatingRepository extends AbstractRepository implements UserRatingRepositoryInterface
{
    /**
     * Return list of user ratings
     *
     * @param $gameId
     *
     * @return UserRatingInterface[]
     */
    public function getList($gameId)
    {
        return $this->getRepository()->findBy(['gameId' => $gameId]);
    }

    /**
     * Removes user rating
     *
     * @param UserRatingInterface $rating
     */
    public function remove(UserRatingInterface $rating)
    {
        $this->getDocumentManager()->remove($rating);
        $this->getDocumentManager()->flush($rating);
    }

    /**
     * Saves user rating
     *
     * @param UserRatingInterface $rating
     */
    public function save(UserRatingInterface $rating)
    {
        $this->getDocumentManager()->persist($rating);
        $this->getDocumentManager()->flush($rating);
    }

    /**
     * Return object repository
     *
     * @return ObjectRepository
     */
    private function getRepository()
    {
        return $this->getDocumentManager()->getRepository(UserRating::class);
    }
}