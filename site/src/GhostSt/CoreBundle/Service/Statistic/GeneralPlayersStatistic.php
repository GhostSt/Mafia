<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 0:20
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Statistic;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\User;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Game\GameResultResolverInterface;
use GhostSt\CoreBundle\Service\Game\GameServiceInterface;
use GhostSt\CoreBundle\Service\Rating\RatingServiceInterface;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;
use GhostSt\CoreBundle\Service\User\UserServiceInterface;
use GhostSt\CoreBundle\View\RatingContainer;

/**
 */
class GeneralPlayersStatistic
{
    /**
     * @var GameResultResolverInterface
     */
    private $gameResultResolver;

    /**
     * @var GameServiceInterface
     */
    private $gameService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var PlayerRoleServiceInterface
     */
    private $playerRoleService;

    /**
     * @var RatingServiceInterface
     */
    private $ratingService;

    /**
     * @var RatingContainer[]
     */
    private $ratings = [];

    public function __construct(
        GameResultResolverInterface $gameResultResolver,
        GameServiceInterface $gameService,
        UserServiceInterface $userService,
        RatingServiceInterface $ratingService,
        PlayerRoleServiceInterface $playerRoleService
    ) {
        $this->gameResultResolver = $gameResultResolver;
        $this->gameService        = $gameService;
        $this->userService        = $userService;
        $this->ratingService      = $ratingService;
        $this->playerRoleService  = $playerRoleService;
    }

    /**
     * @return array|RatingContainer[]
     */
    public function calculateStatistic(): array
    {
        $ratingContainers = [];
        $games            = $this->gameService->getList();

        foreach ($games as $game) {
            $ratings = $this->ratingService->getGameRatings($game);

            foreach ($game->getPlayers() as $player) {
                $ratingContainer = new RatingContainer();
                $ratingContainer->setUser($player->getUser());
                $ratingContainer->addGame($game->getId());

                $ratingContainers[$player->getUser()->getId()] = $ratingContainer;

                if ($this->gameResultResolver->isPlayerWin($game, $player)) {
                    $ratingContainer->increaseWin();
                }

                if ($this->playerRoleService->isMafia($player)) {
                    $ratingContainer->getMafia()->increaseGames();

                    if ($this->gameResultResolver->isMafiaWin($game)) {
                        $ratingContainer->getMafia()->increaseWin();
                    } else {
                        $ratingContainer->getMafia()->increaseLost();
                    }
                }

                if ($this->playerRoleService->isCivilian($player)) {
                    $ratingContainer->getCivilian()->increaseGames();

                    if ($this->gameResultResolver->isCivilianWin($game)) {
                        $ratingContainer->getCivilian()->increaseWin();
                    } else {
                        $ratingContainer->getCivilian()->increaseLost();
                    }
                }
            }

            unset($ratingContainer);

            foreach ($ratings as $rating) {
                $ratingContainer = $ratingContainers[$rating->getUserId()];

                $ratingContainer->increaseScore($rating->getScore());

                if ($rating->isBonusRating()) {
                    $ratingContainer->increaseBonus($rating->getScore());
                }

                $player = $game->getPlayerByUserId($rating->getUserId());

                if ($this->playerRoleService->isCivilian($player)) {
                    $ratingContainer->getCivilian()->increaseScore($rating->getScore());
                }

                if ($this->playerRoleService->isMafia($player)) {
                    $ratingContainer->getMafia()->increaseScore($rating->getScore());
                }
            }
        }
    }
}