<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Rating;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Repository\Rating\UserRatingRepositoryInterface;

/**
 * Rating service
 */
class RatingService implements RatingServiceInterface
{
    /**
     * Rating calculator
     *
     * @var RatingCalculatorInterface
     */
    private $calculator;

    /**
     * User rating repository
     *
     * @var UserRatingRepositoryInterface
     */
    private $ratingRepository;

    /**
     * RatingService constructor.
     *
     * @param RatingCalculatorInterface     $ratingCalculator
     * @param UserRatingRepositoryInterface $ratingRepository
     */
    public function __construct(
        RatingCalculatorInterface $ratingCalculator,
        UserRatingRepositoryInterface $ratingRepository
    ) {
        $this->calculator       = $ratingCalculator;
        $this->ratingRepository = $ratingRepository;
    }

    /**
     * Creates game rating
     *
     * @param GameInterface $game
     */
    public function createGameRating(GameInterface $game): void
    {
        $ratings = $this->calculator->calculate($game);

        foreach ($ratings as $rating) {
            $this->ratingRepository->save($rating);
        }
    }

    /**
     * Gets list of ratings
     *
     * @param GameInterface $game
     *
     * @return UserRatingInterface[]
     */
    public function getGameRatings(GameInterface $game): array
    {
        return $this->ratingRepository->getRatingsByGameId($game->getId());
    }

    /**
     * Updates game rating that contains rating of every game player
     *
     * @param GameInterface $game
     */
    public function updateGameRating(GameInterface $game): void
    {
        $this->removeRating($game);

        $this->createGameRating($game);
    }

    /**
     * Removes game rating
     *
     * @param GameInterface $game
     */
    private function removeRating(GameInterface $game): void
    {
        $this->ratingRepository->removeRatingsByGameId($game->getId());
    }
}
