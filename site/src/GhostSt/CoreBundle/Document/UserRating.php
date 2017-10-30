<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * User rating
 *
 * @ODM\Document(collection="user_rating")
 */
class UserRating implements UserRatingInterface
{
    /**
     * User rating id
     *
     * @var string
     *
     * @ODM\Id()
     */
    private $id;

    /**
     * User id
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $userId;

    /**
     * Game id
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $gameId;

    /**
     * Rating code
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $code;

    /**
     * Score
     *
     * @var double
     *
     * @ODM\Field(type="float")
     */
    private $score;

    /**
     * Constructor
     *
     * @param string $userId
     * @param string $gameId
     * @param string $code
     * @param double $score
     */
    public function __construct($userId, $gameId, $code, $score)
    {
        $this->userId = $userId;
        $this->gameId = $gameId;
        $this->code   = $code;
        $this->score  = $score;
    }

    /**
     * Returns user rating id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns user id
     *
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * Returns game id
     *
     * @return string
     */
    public function getGameId(): string
    {
        return $this->gameId;
    }

    /**
     * Returns code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Returns score
     *
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * Checks if its a bonus rating
     *
     * @return bool
     */
    public function isBonusRating(): bool
    {
        if ($this->code === UserRatingInterface::RATING_CODE_WIN_BEST_MOVE) {
            return true;
        }

        return false;
    }
}
