<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Rating;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\UserRatingInterface;

/**
 * Rating service
 */
interface RatingServiceInterface
{
    /**
     * Creates game rating that contains rating of every game player
     *
     * @param GameInterface $game
     */
    public function createGameRating(GameInterface $game): void;

    /**
     * Gets list of ratings
     *
     * @param GameInterface $game
     *
     * @return UserRatingInterface[]
     */
    public function getGameRatings(GameInterface $game): array;

    /**
     * Updates game rating that contains rating of every game player
     *
     * @param GameInterface $game
     */
    public function updateGameRating(GameInterface $game): void;
}
