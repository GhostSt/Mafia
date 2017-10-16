<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameBestMoveInterface;
use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRating;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;

/**
 * Best move rating calculation strategy
 */
class BestMoveStrategy implements StrategyInterface
{
    /**
     * Role service
     *
     * @var PlayerRoleServiceInterface
     */
    private $roleService;

    /**
     * Constructor
     *
     * @param PlayerRoleServiceInterface $roleService
     */
    public function __construct(PlayerRoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Creates player rating
     *
     * @param GameInterface       $game
     * @param GamePlayerInterface $player
     *
     * @return UserRatingInterface[]
     */
    public function createRatings(GameInterface $game, GamePlayerInterface $player): array
    {
        $positiveGuesses = 0;
        $score           = 0;

        $mafiaPositions = [];

        if ($game->getBestMove()->getPosition() !== $player->getPosition()) {
            return [];
        }

        foreach ($game->getPlayers() as $gamePlayer) {
            if ($this->roleService->isMafia($gamePlayer)) {
                $mafiaPositions[] = $gamePlayer->getPosition();
            }
        }

        foreach ($game->getBestMove()->getGuess() as $guess) {
            if (in_array($guess, $mafiaPositions)) {
                $positiveGuesses++;
            }
        }

        if ($positiveGuesses < 2 || $positiveGuesses > 3) {
            return [];
        }

        if ($positiveGuesses === 3) {
            $score = GameBestMoveInterface::BEST_MOVE_FULL_BONUS;
        }

        if ($positiveGuesses === 2) {
            $score = GameBestMoveInterface::BEST_MOVE_HALF_BONUS;
        }

        $rating = new UserRating(
            $player->getUser()->getId(),
            $game->getId(),
            UserRatingInterface::RATING_CODE_WIN_BEST_MOVE,
            $score
        );

        return [$rating];
    }
}
