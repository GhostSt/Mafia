<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 0:22
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Game;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Filter\DateFilterInterface;

/**
 * Game service interface
 */
interface GameServiceInterface
{
    /**
     * Gets list of games
     *
     * @param DateFilterInterface $filter
     *
     * @return GameInterface[]
     */
    public function getList(DateFilterInterface $filter): array;
}