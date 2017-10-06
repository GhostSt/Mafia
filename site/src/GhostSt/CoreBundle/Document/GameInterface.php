<?php

namespace GhostSt\CoreBundle\Document;

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
    public function getId();

    /**
     * Gets days
     *
     * @return Collection|GameDay[] $days
     */
    public function getDays();

    /**
     * Gets players
     *
     * @return Collection|GamePlayer[] $players
     */
    public function getPlayers();

    /**
     * Gets bestMove
     *
     * @return GameBestMove $bestMove
     */
    public function getBestMove();

    /**
     * Gets result
     *
     * @return boolean $result
     */
    public function getResult();

    /**
     * Gets date
     *
     * @return \DateTime $date
     */
    public function getDate();
}
