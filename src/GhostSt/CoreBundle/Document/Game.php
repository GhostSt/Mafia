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
     */
    protected $players;
    /**
     * @var ArrayCollection
     *
     * @ODM\EmbedMany(targetDocument="GameDay")
     */
    protected $days;
    /**
     * true equals civilian win, false equals mafia wins
     *
     * @var boolean
     */
    protected $result;
    /**
     * @var GameBestMove
     *
     * @ODM\EmbedOne(targetDocument="GameBestMove")
     */
    protected $bestMove;

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
}
