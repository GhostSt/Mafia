<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 23:39
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Game;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;

/**
 * Game result resolver interface
 */
interface GameResultResolverInterface
{
    /**
     * Checks if civilian wins in the game
     *
     * @param GameInterface $game
     *
     * @return bool
     */
    public function isCivilianWin(GameInterface $game): bool;

    /**
     * Check if mafia wins in the game
     *
     * @param GameInterface $game
     *
     * @return bool
     */
    public function isMafiaWin(GameInterface $game): bool;

    /**
     * Resolves if player wins in game
     *
     * @param GameInterface       $game
     * @param GamePlayerInterface $player
     *
     * @return bool
     */
    public function isPlayerWin(GameInterface $game, GamePlayerInterface $player): bool;
}