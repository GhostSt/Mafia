<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

use DateTime;
use Doctrine\Common\Collections\Collection;

/**
 * Game interface
 */
interface GameInterface
{
    const WIN_SCORE_BONUS = 1;

    const WIN_CIVILIAN    = true;

    const WIN_MAFIA       = false;

    /**
     * Gets id
     *
     * @return string $id
     */
    public function getId(): string;

    /**
     * Gets dame days
     *
     * @return Collection|GameDayInterface[] $days
     */
    public function getDays(): Collection;

    /**
     * Gets game players
     *
     * @return Collection|GamePlayerInterface[] $players
     */
    public function getPlayers(): Collection;

    /**
     * Gets game bestMove
     *
     * @return GameBestMoveInterface $bestMove
     */
    public function getBestMove(): GameBestMoveInterface;

    /**
     * Gets game result
     *
     * @return boolean $result
     */
    public function getResult(): bool;

    /**
     * Gets created date
     *
     * @return DateTime $date
     */
    public function getDate(): DateTime;
}
