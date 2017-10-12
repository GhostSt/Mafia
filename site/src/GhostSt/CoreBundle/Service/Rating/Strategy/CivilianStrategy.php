<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRating;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;

/**
 * Civilian rating calculation strategy
 */
class CivilianStrategy implements StrategyInterface
{
    /**
     * Role service
     *
     * @var PlayerRoleServiceInterface
     */
    private $roleService;

    /**
     * CivilianStrategy constructor.
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
    public function createRatings(GameInterface $game, GamePlayerInterface $player)
    {
        if ($game->getResult() !== GameInterface::WIN_CIVILIAN
            || !$this->roleService->isCivilian($player)
        ) {
            return [];
        }

        $rating = new UserRating(
            $player->getUser()->getId(),
            $game->getId(),
            UserRatingInterface::RATING_CODE_WIN_CIVILIAN,
            GameInterface::WIN_SCORE_BONUS
        );

        return [$rating];
    }
}
