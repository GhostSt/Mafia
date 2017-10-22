<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 19.10.17
 * Time: 20:05
 *
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Game;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;

/**
 * Game result resolver
 */
class GameResultResolver implements GameResultResolverInterface
{
    /**
     * Player role service
     *
     * @var PlayerRoleServiceInterface
     */
    private $playerRoleService;

    /**
     * Constructor
     *
     * @param PlayerRoleServiceInterface $playerRoleService
     */
    public function __construct(PlayerRoleServiceInterface $playerRoleService)
    {
        $this->playerRoleService = $playerRoleService;
    }

    /**
     * Checks if civilian wins in the game
     *
     * @param GameInterface $game
     *
     * @return bool
     */
    public function isCivilianWin(GameInterface $game): bool
    {
        if ($game->getResult() === GameInterface::WIN_CIVILIAN) {
            return true;
        }

        return false;
    }

    /**
     * Check if mafia wins in the game
     *
     * @param GameInterface $game
     *
     * @return bool
     */
    public function isMafiaWin(GameInterface $game): bool
    {
        if ($game->getResult() === GameInterface::WIN_MAFIA) {
            return true;
        }

        return false;
    }

    /**
     * Resolves if player wins in game
     *
     * @param GameInterface       $game
     * @param GamePlayerInterface $player
     *
     * @return bool
     */
    public function isPlayerWin(GameInterface $game, GamePlayerInterface $player): bool
    {
        if ($this->isCivilianWin($game) && $this->playerRoleService->isCivilian($player)) {
            return true;
        }

        if ($this->isMafiaWin($game) && $this->playerRoleService->isMafia($player)) {
            return true;
        }

        return false;
    }
}