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
     * @var int
     *
     * @ODM\Id()
     */
    private $id;

    /**
     * User id
     *
     * @var int
     *
     * @ODM\Field(type="integer")
     */
    private $userId;

    /**
     * Game id
     *
     * @var int
     *
     * @ODM\Field(type="integer")
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns user id
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Returns game id
     *
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * Returns code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns score
     *
     * @return double
     */
    public function getScore()
    {
        return $this->score;
    }
}
