<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 0:20
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Statistic;

use GhostSt\CoreBundle\Service\Game\GameServiceInterface;
use GhostSt\CoreBundle\Service\Rating\RatingServiceInterface;
use GhostSt\CoreBundle\View\RatingContainer;

/**
 * General players statistic
 */
class GeneralPlayersStatistic implements GeneralPlayersStatisticInterface
{
    /**
     * Game service
     *
     * @var GameServiceInterface
     */
    private $gameService;

    /**
     * Rating service
     *
     * @var RatingServiceInterface
     */
    private $ratingService;

    /**
     * Statistic calculator
     *
     * @var StatisticCalculatorInterface
     */
    private $statisticCalculator;

    /**
     * Constructor
     *
     * @param GameServiceInterface         $gameService
     * @param RatingServiceInterface       $ratingService
     * @param StatisticCalculatorInterface $statisticCalculator
     */
    public function __construct(
        GameServiceInterface $gameService,
        RatingServiceInterface $ratingService,
        StatisticCalculatorInterface $statisticCalculator
    ) {
        $this->gameService         = $gameService;
        $this->ratingService       = $ratingService;
        $this->statisticCalculator = $statisticCalculator;
    }

    /**
     * Calculates statistic
     *
     * @return array|RatingContainer[]
     */
    public function calculateStatistic(): array
    {
        $ratingContainers = [];
        $games            = $this->gameService->getList();

        foreach ($games as $game) {
            $ratings = $this->ratingService->getGameRatings($game);

            foreach ($game->getPlayers() as $player) {
                $userId          = $player->getUser()->getId();
                $ratingContainer = $ratingContainers[$userId] ?? null;

                if (null === $ratingContainer) {
                    $ratingContainer = new RatingContainer($player->getUser());
                    $ratingContainer->addGame($game->getId());

                    $ratingContainers[$player->getUser()->getId()] = $ratingContainer;
                }

                $this->statisticCalculator->updateWinCounter($game, $player, $ratingContainer);

                $this->statisticCalculator->updateCivilianCounters(
                    $game,
                    $player,
                    $ratingContainer->getCivilian()
                );

                $this->statisticCalculator->updateMafiaCounters(
                    $game,
                    $player,
                    $ratingContainer->getMafia()
                );
            }

            foreach ($ratings as $rating) {
                $ratingContainer = $ratingContainers[$rating->getUserId()];

                $this->statisticCalculator->calculateScores($game, $rating, $ratingContainer);
            }
        }

        return $ratingContainers;
    }
}