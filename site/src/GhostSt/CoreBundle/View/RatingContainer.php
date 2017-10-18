<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 0:39
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\View;

use GhostSt\CoreBundle\Document\User;

/**
 * Rating container
 */
class RatingContainer
{
    /**
     * User identifier
     *
     * @var User
     */
    private $user;

    /**
     * Game identifiers
     *
     * @var array
     */
    private $games = [];

    /**
     * Game statistic by playing for civilian
     *
     * @var RoleStatisticContainer
     */
    private $civilian;

    /**
     * Game statistic by playing for mafia
     *
     * @var RoleStatisticContainer
     */
    private $mafia;

    /**
     * Win quantity
     *
     * @var int
     */
    private $win = 0;

    /**
     * Bonus score
     *
     * @var float
     */
    private $bonus = 0.0;

    /**
     * Total score
     *
     * @var float
     */
    private $score = 0.0;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->civilian = new RoleStatisticContainer();
        $this->mafia    = new RoleStatisticContainer();
    }

    /**
     * @return null|User
     */
    public function getUser():? User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getGames(): array
    {
        return $this->games;
    }

    /**
     * @return int
     */
    public function getGamesQuantity(): int
    {
        return count($this->games);
    }

    /**
     * @param string $game
     */
    public function addGame(string $game): void
    {
        if (in_array($game, $this->games, true)) {
            return;
        }

        $this->games[] = $game;
    }

    /**
     * @return RoleStatisticContainer
     */
    public function getCivilian(): RoleStatisticContainer
    {
        return $this->civilian;
    }

    /**
     * @return RoleStatisticContainer
     */
    public function getMafia(): RoleStatisticContainer
    {
        return $this->mafia;
    }

    /**
     * @return int
     */
    public function getWin(): int
    {
        return $this->win;
    }

    /**
     */
    public function increaseWin(): void
    {
        $this->win++;
    }

    /**
     * @return int
     */
    public function getLose(): int
    {
        return $this->getGamesQuantity() - $this->getWin();
    }

    /**
     * @return float
     */
    public function getBonus(): float
    {
        return $this->bonus;
    }

    /**
     * @param float $bonus
     */
    public function increaseBonus(float $bonus): void
    {
        $this->bonus += $bonus;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function increaseScore(float $score): void
    {
        $this->score += $score;
    }

    public function calculateRating(): float
    {
        return $this->score / $this->getGamesQuantity();
    }
}