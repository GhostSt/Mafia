<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.03.17
 * Time: 0:47
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Game
 *
 * @ODM\Document(collection="game")
 */
class Game implements GameInterface
{
    /**
     * Game identifier
     *
     * @var string
     *
     * @ODM\Id
     */
    protected $id;

    /**
     * Game players
     *
     * @var Collection|GamePlayerInterface[]
     *
     * @ODM\EmbedMany(targetDocument="GamePlayer")
     * @Assert\NotBlank(
     *     message="document.game.players.not_blank"
     * )
     * @Assert\Valid()
     */
    protected $players;

    /**
     * Game days
     *
     * @var Collection|GameDayInterface[]
     *
     * @ODM\EmbedMany(targetDocument="GameDay")
     * @Assert\NotBlank(
     *     message="document.game.days.not_blank"
     * )
     * @Assert\Valid()
     */
    protected $days;

    /**
     * Game result. True equals civilian win, false equals mafia wins
     *
     * @var boolean
     *
     * @ODM\Field(type="boolean")
     */
    protected $result = false;

    /**
     * Game best move
     *
     * @var GameBestMoveInterface
     *
     * @ODM\EmbedOne(targetDocument="GameBestMove")
     * @Assert\Valid()
     */
    protected $bestMove;

    /**
     * Created date
     *
     * @var DateTime
     *
     * @ODM\Field(type="date")
     */
    protected $date;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players  = new ArrayCollection();
        $this->days     = new ArrayCollection();
        $this->bestMove = new GameBestMove();
        $this->date     = new DateTime();
    }

    /**
     * Gets id
     *
     * @return string $id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Adds game day
     *
     * @param GameDayInterface $day
     *
     */
    public function addDay(GameDayInterface $day): void
    {
        $this->days[] = $day;
    }

    /**
     * Removes game day
     *
     * @param GameDayInterface $day
     */
    public function removeDay(GameDayInterface $day): void
    {
        $this->days->removeElement($day);
    }

    /**
     * Gets all game days
     *
     * @return Collection|GameDayInterface[] $days
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    /**
     * Adds game player
     *
     * @param GamePlayerInterface $player
     */
    public function addPlayer(GamePlayerInterface $player): void
    {
        $this->players[] = $player;
    }

    /**
     * Removes game player
     *
     * @param GamePlayerInterface $player
     */
    public function removePlayer(GamePlayerInterface $player): void
    {
        $this->players->removeElement($player);
    }

    /**
     * Gets game players
     *
     * @return Collection|GamePlayerInterface[] $players
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    /**
     * Sets game bestMove
     *
     * @param GameBestMoveInterface $bestMove
     *
     * @return self
     */
    public function setBestMove(GameBestMoveInterface $bestMove): self
    {
        $this->bestMove = $bestMove;

        return $this;
    }

    /**
     * Gets game bestMove
     *
     * @return GameBestMoveInterface $bestMove
     */
    public function getBestMove(): GameBestMoveInterface
    {
        return $this->bestMove;
    }

    /**
     * Sets game result
     *
     * @param bool $result
     *
     * @return self
     */
    public function setResult(bool $result): self
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Gets game result
     *
     * @return bool $result
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Sets created date
     *
     * @param DateTime $date
     *
     * @return self
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Gets created date
     *
     * @return DateTime $date
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Gets player by user id
     *
     * @param string $userId
     *
     * @return GamePlayerInterface|null
     */
    public function getPlayerByUserId(string $userId):? GamePlayerInterface
    {
        foreach($this->getPlayers() as $player) {
            if ($player->getUser()->getId() === $userId) {
                return $player;
            }
        }

        return null;
    }
}
