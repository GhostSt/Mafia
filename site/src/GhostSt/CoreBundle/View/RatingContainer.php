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
     * Рейтинг
     *
     * @var float
     */
    private $rating = 0.0;

    /**
     * Constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;

        $this->civilian = new RoleStatisticContainer();
        $this->mafia    = new RoleStatisticContainer();
    }

    /**
     * Gets user
     *
     * @return null|User
     */
    public function getUser():? User
    {
        return $this->user;
    }

    /**
     * Gets list of game identifiers
     *
     * @return array
     */
    public function getGames(): array
    {
        return $this->games;
    }

    /**
     * Gets quantity of games
     *
     * @return int
     */
    public function getGamesQuantity(): int
    {
        return count($this->games);
    }

    /**
     * Adds game identifier to list
     *
     * @param string $game
     */
    public function addGame(string $game): void
    {
        if (in_array($game, $this->games, true)) {
            return;
        }

        $this->games[] = $game;

        $this->calculateRating();
    }

    /**
     * Gets civilian statistic container
     *
     * @return RoleStatisticContainer
     */
    public function getCivilian(): RoleStatisticContainer
    {
        return $this->civilian;
    }

    /**
     * Gets mafia statistic container
     *
     * @return RoleStatisticContainer
     */
    public function getMafia(): RoleStatisticContainer
    {
        return $this->mafia;
    }

    /**
     * Gets wins quantity
     *
     * @return int
     */
    public function getWins(): int
    {
        return $this->win;
    }

    /**
     * Increases wins quantity
     */
    public function increaseWin(): void
    {
        $this->win++;
    }

    /**
     * Gets loses quantity
     *
     * @return int
     */
    public function getLoses(): int
    {
        return $this->getGamesQuantity() - $this->getWins();
    }

    /**
     * Gets bonus score
     *
     * @return float
     */
    public function getBonus(): float
    {
        return $this->bonus;
    }

    /**
     * Increases bonus score
     *
     * @param float $bonus
     */
    public function increaseBonus(float $bonus): void
    {
        $this->bonus += $bonus;
    }

    /**
     * Gets total score
     *
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * Increases total score
     *
     * @param float $score
     */
    public function increaseScore(float $score): void
    {
        $this->score += $score;

        $this->calculateRating();
    }

    /**
     * Calculates player rating
     *
     * @return void
     */
    public function calculateRating(): void
    {
        if ($this->getGamesQuantity() === 0) {
            return;
        }

        $this->rating = $this->score / $this->getGamesQuantity();
    }

    /**
     * Gets rating
     *
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }
}