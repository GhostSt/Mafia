<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 06.10.17
 * Time: 20:56
 */

namespace GhostSt\CoreBundle\Repository\Rating;

use GhostSt\CoreBundle\Document\UserRatingInterface;

/**
 * User rating repository interface
 */
interface UserRatingRepositoryInterface
{
    /**
     * Return list of user ratings
     *
     * @param $gameId
     *
     * @return UserRatingInterface[]
     */
    public function getList($gameId);

    /**
     * Saves user rating
     *
     * @param UserRatingInterface $rating
     */
    public function save(UserRatingInterface $rating);

    /**
     * Removes user rating
     *
     * @param UserRatingInterface $rating
     */
    public function remove(UserRatingInterface $rating);
}