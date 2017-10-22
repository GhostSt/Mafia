<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.10.17
 * Time: 23:07
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Statistic;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayer;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Game\GameResultResolverInterface;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;
use GhostSt\CoreBundle\View\RatingContainer;
use GhostSt\CoreBundle\View\RoleStatisticContainer;

/**
 * Statistic calculator
 */
class StatisticCalculator implements StatisticCalculatorInterface
{
    /**
     * Game result resolver
     *
     * @var GameResultResolverInterface
     */
    private $gameResultResolver;

    /**
     * Player role service
     *
     * @var PlayerRoleServiceInterface
     */
    private $playerRoleService;

    /**
     * Constructor
     *
     * @param GameResultResolverInterface $gameResultResolver
     * @param PlayerRoleServiceInterface  $playerRoleService
     */
    public function __construct(
        GameResultResolverInterface $gameResultResolver,
        PlayerRoleServiceInterface $playerRoleService
    ) {
        $this->gameResultResolver = $gameResultResolver;
        $this->playerRoleService  = $playerRoleService;
    }

    /**
     * Calculates scores
     *
     * @param GameInterface       $game
     * @param UserRatingInterface $rating
     * @param RatingContainer     $ratingContainer
     *
     * @return void
     */
    public function calculateScores(
        GameInterface $game,
        UserRatingInterface $rating,
        RatingContainer $ratingContainer
    ): void {
        $player = $game->getPlayerByUserId($rating->getUserId());

        $ratingContainer->increaseScore($rating->getScore());

        if ($rating->isBonusRating()) {
            $ratingContainer->increaseBonus($rating->getScore());
        }

        if ($this->playerRoleService->isCivilian($player)) {
            $ratingContainer->getCivilian()->increaseScore($rating->getScore());
        }

        if ($this->playerRoleService->isMafia($player)) {
            $ratingContainer->getMafia()->increaseScore($rating->getScore());
        }
    }

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
    ): void {
        if ($this->playerRoleService->isCivilian($player)) {
            $container->increaseGames();

            if ($this->gameResultResolver->isCivilianWin($game)) {
                $container->increaseWin();
            } else {
                $container->increaseLost();
            }
        }
    }

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
    ): void {
        if ($this->playerRoleService->isMafia($player)) {
            $container->increaseGames();

            if ($this->gameResultResolver->isMafiaWin($game)) {
                $container->increaseWin();
            } else {
                $container->increaseLost();
            }
        }
    }

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
    ): void {
        if ($this->gameResultResolver->isPlayerWin($game, $player)) {
            $ratingContainer->increaseWin();
        }
    }
}