<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 0:22
 */
namespace GhostSt\CoreBundle\Service\Game;

use GhostSt\CoreBundle\Document\GameInterface;

/**
 * Game service interface
 */
interface GameServiceInterface
{
    /**
     * Gets list of games
     *
     * @return GameInterface[]
     */
    public function getList(): array;
}