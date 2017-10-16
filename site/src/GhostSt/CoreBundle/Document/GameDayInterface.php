<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 15.10.17
 * Time: 18:51
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

/**
 * Game day interface
 */
interface GameDayInterface
{
    /**
     * Returns player position who left city today
     *
     * @return int
     */
    public function getLeft(): int;

    /**
     * Returns player position who has been killed tonight
     *
     * @return int $killed
     */
    public function getKilled(): int;

    /**
     * Return player position who has been checked by don tonight
     *
     * @return int $checkDon
     */
    public function getCheckDon(): int;

    /**
     * Return player position who has been checked by sheriff tonight
     *
     * @return int $checkSheriff
     */
    public function getCheckSheriff(): int;

    /**
     * Returns daily voting
     *
     * @return array $voting
     */
    public function getVoting(): array;
}