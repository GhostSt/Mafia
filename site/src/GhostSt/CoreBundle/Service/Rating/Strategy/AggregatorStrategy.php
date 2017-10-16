<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRatingInterface;

/**
 * Aggregator rating calculation strategy
 */
class AggregatorStrategy implements StrategyInterface
{
    /**
     * Active strategies
     *
     * @var StrategyInterface[]
     */
    private $strategies;

    /**
     * Adds strategy
     *
     * @param StrategyInterface $strategy
     */
    public function addStrategy(StrategyInterface $strategy): void
    {
        $this->strategies[] = $strategy;
    }

    /**
     * Return aggregated collection of player ratings
     *
     * @param GameInterface       $game
     * @param GamePlayerInterface $player
     *
     * @return UserRatingInterface[]
     */
    public function createRatings(GameInterface $game, GamePlayerInterface $player): array
    {
        $ratings = [];

        foreach ($this->strategies as $strategy) {
            $ratings = array_merge($ratings, $strategy->createRatings($game, $player));
        }

        return $ratings;
    }
}
