<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.03.17
 * Time: 0:47
 */

namespace GhostSt\CoreBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use GhostSt\CoreBundle\Validator\Constraints as CustomAssert;

/**
 * Class Game
 * @package GhostSt\CoreBundle\Document
 *
 * @ODM\Document(collection="game")
 */
class Game
{
    /**
     * @var string
     *
     * @ODM\Id
     */
    protected $id;
    /**
     * @var ArrayCollection
     *
     * @ODM\EmbedMany(targetDocument="GamePlayer")
     * @Assert\NotBlank(
     *     message="document.game.players.not_blank"
     * )
     * @Assert\Valid()
     */
    protected $players;
    /**
     * @var ArrayCollection
     *
     * @ODM\EmbedMany(targetDocument="GameDay")
     * @Assert\NotBlank(
     *     message="document.game.days.not_blank"
     * )
     * @Assert\Valid()
     */
    protected $days;
    /**
     * true equals civilian win, false equals mafia wins
     *
     * @var boolean
     *
     * @ODM\Field(type="boolean")
     */
    protected $result;
    /**
     * @var GameBestMove
     *
     * @ODM\EmbedOne(targetDocument="GameBestMove")
     * @Assert\Valid()
     */
    protected $bestMove;
    /**
     * @var \DateTime
     *
     * @ODM\Field(type="date")
     */
    protected $date;

    public function __construct()
    {
        $this->days = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add day
     *
     * @param GameDay $day
     */
    public function addDay(GameDay $day)
    {
        $this->days[] = $day;
    }

    /**
     * Remove day
     *
     * @param GameDay $day
     */
    public function removeDay(GameDay $day)
    {
        $this->days->removeElement($day);
    }

    /**
     * Get days
     *
     * @return \Doctrine\Common\Collections\Collection $days
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Add player
     *
     * @param GamePlayer $player
     */
    public function addPlayer(GamePlayer $player)
    {
        $this->players[] = $player;
    }

    /**
     * Remove player
     *
     * @param GamePlayer $player
     */
    public function removePlayer(GamePlayer $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection $players
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Set bestMove
     *
     * @param GameBestMove $bestMove
     * @return $this
     */
    public function setBestMove(GameBestMove $bestMove)
    {
        $this->bestMove = $bestMove;
        return $this;
    }

    /**
     * Get bestMove
     *
     * @return GameBestMove $bestMove
     */
    public function getBestMove()
    {
        return $this->bestMove;
    }

    /**
     * Set result
     *
     * @param boolean $result
     * @return $this
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * Get result
     *
     * @return boolean $result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime $date
     */
    public function getDate()
    {
        return $this->date;
    }
}
