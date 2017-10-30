<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 11:29
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\View;

/**
 * Role statistic container
 */
class RoleStatisticContainer
{
    /**
     * @var int
     */
    private $games = 0;

    /**
     * @var int
     */
    private $win = 0;

    /**
     * @var int
     */
    private $loses = 0;

    /**
     * @var float
     */
    private $score = 0.0;

    /**
     * @return int
     */
    public function getGames(): int
    {
        return $this->games;
    }

    /**
     */
    public function increaseGames(): void
    {
        $this->games++;
    }

    /**
     * @return int
     */
    public function getWins(): int
    {
        return $this->win;
    }

    /**
     *
     */
    public function increaseWin(): void
    {
        $this->win++;
    }

    /**
     * @return int
     */
    public function getLoses(): int
    {
        return $this->loses;
    }

    /**
     */
    public function increaseLose(): void
    {
        $this->loses++;
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
}