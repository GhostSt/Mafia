<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 19.10.17
 * Time: 19:56
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Game;

use GhostSt\CoreBundle\Filter\DateFilterInterface;

/**
 * Game repository interface
 */
interface GameRepositoryInterface
{
    /**
     * Gets list of games
     *
     * @param DateFilterInterface $filter
     *
     * @return array
     */
    public function getList(DateFilterInterface $filter): array;
}