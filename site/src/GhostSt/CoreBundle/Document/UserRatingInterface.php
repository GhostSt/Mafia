<?php

namespace GhostSt\CoreBundle\Document;

/**
 * User rating interface
 */
interface UserRatingInterface
{
    const RATING_CODE_WIN_CIVILIAN  = 0x01;

    const RATING_CODE_WIN_MAFIA     = 0x02;

    const RATING_CODE_WIN_BEST_MOVE = 0x03;

    /**
     * Returns user rating id
     *
     * @return int
     */
    public function getId();

    /**
     * Returns user id
     *
     * @return int
     */
    public function getUserId();

    /**
     * Returns game id
     *
     * @return int
     */
    public function getGameId();

    /**
     * Returns code
     *
     * @return string
     */
    public function getCode();

    /**
     * Returns score
     *
     * @return double
     */
    public function getScore();
}
