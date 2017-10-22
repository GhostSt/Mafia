<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 19.10.17
 * Time: 20:01
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Game;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Repository\Game\GameRepositoryInterface;

/**
 * Game service
 */
class GameService implements GameServiceInterface
{
    /**
     * Game repository
     *
     * @var GameRepositoryInterface
     */
    private $gameRepository;

    /**
     * Constructor
     *
     * @param GameRepositoryInterface $gameRepository
     */
    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * Gets list of games
     *
     * @return GameInterface[]
     */
    public function getList(): array
    {
        return $this->gameRepository->getList();
    }
}