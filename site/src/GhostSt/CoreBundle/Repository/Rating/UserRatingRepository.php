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
use Symfony\Bridge\Doctrine\ManagerRegistry;

class UserRatingRepository implements UserRatingRepositoryInterface
{
    /**
     * Object manager
     *
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->manager = $managerRegistry->getManager();
    }

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
     * Saves user rating
     *
     * @param UserRatingInterface $rating
     */
    public function save(UserRatingInterface $rating)
    {
        $this->manager->persist($rating);
        $this->manager->flush($rating);
    }

    /**
     * Removes user rating
     *
     * @param UserRatingInterface $rating
     */
    public function remove(UserRatingInterface $rating)
    {
        $this->manager->remove($rating);
        $this->manager->flush($rating);
    }

    /**
     * Return object repository
     *
     * @return ObjectRepository
     */
    private function getRepository()
    {
        return $this->manager->getRepository(UserRating::class);
    }
}