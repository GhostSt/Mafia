<?php

namespace GhostSt\CoreBundle\Service\Rating;

use GhostSt\CoreBundle\Document\GameInterface;

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
    public function createGameRating(GameInterface $game);

    /**
     * Updates game rating that contains rating of every game player
     *
     * @param GameInterface $game
     */
    public function updateGameRating(GameInterface $game);
}