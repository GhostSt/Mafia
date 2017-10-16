<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRating;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;

/**
 * Mafia rating calculation strategy
 */
class MafiaStrategy implements StrategyInterface
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
        if ($game->getResult() !== GameInterface::WIN_MAFIA
            || !$this->roleService->isMafia($player)) {
            return [];
        }
        $score = GameInterface::WIN_SCORE_BONUS;

        $rating = new UserRating(
            $player->getUser()->getId(),
            $game->getId(),
            UserRatingInterface::RATING_CODE_WIN_MAFIA,
            $score
        );

        return [$rating];
    }
}
