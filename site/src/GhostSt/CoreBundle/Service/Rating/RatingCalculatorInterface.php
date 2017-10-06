<?php

namespace GhostSt\CoreBundle\Service\Rating;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\UserRatingInterface;

/**
 * Rating calculator
 */
interface RatingCalculatorInterface
{
    /**
     * Calculate player ratings
     *
     * @param GameInterface $game
     *
     * @return UserRatingInterface[]
     */
    public function calculate(GameInterface $game);
}
