<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.03.17
 * Time: 22:11
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use GhostSt\CoreBundle\Validator\Constraints as CustomAssert;

/**
 * Game day
 *
 * @ODM\EmbeddedDocument
 */
class GameDay implements GameDayInterface
{
    /**
     * Player position that left city
     *
     * @var int
     *
     * @ODM\Field(type="integer")
     * @CustomAssert\Position(
     *     allowZero=true
     * )
     */
    private $left = 0;

    /**
     * Player position that has been killed tonight
     *
     * @var int
     *
     * @ODM\Field(type="integer")
     *
     * @CustomAssert\Position(
     *     allowZero=true
     * )
     */
    private $killed = 0;

    /**
     * Player position who has been checked by don
     *
     * @var int
     *
     * @ODM\Field(type="integer")
     *
     * @CustomAssert\Position(
     *     allowZero=true
     * )
     */
    private $checkDon = 0;

    /**
     * Player position who has been checked by sheriff
     *
     * @var int
     *
     * @ODM\Field(type="integer")
     *
     * @CustomAssert\Position(
     *     allowZero=true
     * )
     */
    private $checkSheriff = 0;

    /**
     * Daily voting
     *
     * @var array
     *
     * @ODM\Field(type="collection")
     */
    private $voting = [];

    /**
     * Returns player position who left city today
     *
     * @return int
     */
    public function getLeft(): int
    {
        return $this->left;
    }

    /**
     * Sets player position who left city today
     *
     * @param int $left
     */
    public function setLeft(int $left): void
    {
        $this->left = $left;
    }

    /**
     * Returns player position who has been killed tonight
     *
     * @return int $killed
     */
    public function getKilled(): int
    {
        return $this->killed;
    }

    /**
     * Sets player position who has been killed tonight
     *
     * @param int $killed
     *
     * @return self
     */
    public function setKilled(int $killed): self
    {
        $this->killed = $killed;

        return $this;
    }

    /**
     * Return player position who has been checked by don tonight
     *
     * @return int $checkDon
     */
    public function getCheckDon(): int
    {
        return $this->checkDon;
    }

    /**
     * Sets player position who has been checked by don tonight
     *
     * @param int $checkDon
     *
     * @return self
     */
    public function setCheckDon(int $checkDon): self
    {
        $this->checkDon = $checkDon;

        return $this;
    }

    /**
     * Return player position who has been checked by sheriff tonight
     *
     * @return int $checkSheriff
     */
    public function getCheckSheriff(): int
    {
        return $this->checkSheriff;
    }

    /**
     * Sets player position who has been checked by sheriff tonight
     *
     * @param int $checkSheriff
     *
     * @return self
     */
    public function setCheckSheriff(int $checkSheriff): self
    {
        $this->checkSheriff = $checkSheriff;

        return $this;
    }

    /**
     * Returns daily voting
     *
     * @return array $voting
     */
    public function getVoting(): array
    {
        return $this->voting;
    }

    /**
     * Sets daily voting
     *
     * @param array $voting
     *
     * @return self
     */
    public function setVoting(array $voting): self
    {
        $this->voting = $voting;

        return $this;
    }
}
