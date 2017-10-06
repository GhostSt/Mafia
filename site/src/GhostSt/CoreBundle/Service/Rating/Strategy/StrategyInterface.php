<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRatingInterface;

/**
 * Rating calculation strategy interface
 */
interface StrategyInterface
{
    /**
     * @param GameInterface       $game
     * @param GamePlayerInterface $player
     *
     * @return UserRatingInterface[]
     */
    public function createRatings(GameInterface $game, GamePlayerInterface $player);
}
