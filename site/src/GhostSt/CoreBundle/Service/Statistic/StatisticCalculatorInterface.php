<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.10.17
 * Time: 0:18
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Statistic;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayer;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\View\RatingContainer;
use GhostSt\CoreBundle\View\RoleStatisticContainer;

interface StatisticCalculatorInterface
{
    /**
     * Updates win counter in rating container
     *
     * @param GameInterface   $game
     * @param GamePlayer      $player
     * @param RatingContainer $ratingContainer
     */
    public function updateWinCounter(
        GameInterface $game,
        GamePlayer $player,
        RatingContainer $ratingContainer
    ): void;

    /**
     * Updates civilian counters
     *
     * @param GameInterface          $game
     * @param GamePlayerInterface    $player
     * @param RoleStatisticContainer $container
     */
    public function updateCivilianCounters(
        GameInterface $game,
        GamePlayerInterface $player,
        RoleStatisticContainer $container
    ): void;

    /**
     * Updates mafia counters
     *
     * @param GameInterface          $game
     * @param GamePlayerInterface    $player
     * @param RoleStatisticContainer $container
     */
    public function updateMafiaCounters(
        GameInterface $game,
        GamePlayerInterface $player,
        RoleStatisticContainer $container
    ): void;
}