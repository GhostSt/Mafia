<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

/**
 * Game best move interface
 */
interface GameBestMoveInterface
{
    const BEST_MOVE_FULL_BONUS = 1;

    const BEST_MOVE_HALF_BONUS = 0.5;

    /**
     * Get position
     *
     * @return int $position
     */
    public function getPosition(): int;

    /**
     * Get guess
     *
     * @return array $guess
     */
    public function getGuess(): array;
}
