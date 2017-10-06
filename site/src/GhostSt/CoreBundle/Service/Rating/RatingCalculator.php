<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Rating;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Service\Rating\Strategy\StrategyInterface;

/**
 * Rating calculator
 */
class RatingCalculator implements RatingCalculatorInterface
{
    /**
     * Rating calculation strategy
     *
     * @var StrategyInterface
     */
    private $strategy;

    /**
     * RatingCalculator constructor.
     *
     * @param StrategyInterface $strategy
     */
    public function __construct(StrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Calculates rating
     *
     * @param GameInterface $game
     *
     * @return array
     */
    public function calculate(GameInterface $game)
    {
        $ratings = [];

        foreach ($game->getPlayers() as $player) {
            $ratings = array_merge($ratings, $this->strategy->createRatings($game, $player));
        }

        return $ratings;
    }
}
