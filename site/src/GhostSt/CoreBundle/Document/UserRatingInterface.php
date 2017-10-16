<?php

declare(strict_types = 1);

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
     * @return string
     */
    public function getId(): string;

    /**
     * Returns user id
     *
     * @return string
     */
    public function getUserId(): string;

    /**
     * Returns game id
     *
     * @return string
     */
    public function getGameId(): string;

    /**
     * Returns code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Returns score
     *
     * @return float
     */
    public function getScore(): float;
}
