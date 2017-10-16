<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.03.17
 * Time: 23:09
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use GhostSt\CoreBundle\Validator\Constraints as CustomAssert;

/**
 * Game best move
 *
 * @ODM\EmbeddedDocument
 */
class GameBestMove implements GameBestMoveInterface
{
    /**
     * Player postion
     *
     * @var integer
     *
     * @ODM\Field(type="integer")
     *
     * @CustomAssert\Position(
     *     allowZero=false
     * )
     */
    protected $position = 0;

    /**
     * Guess. Its a three player positions
     *
     * @var array
     *
     * @ODM\Field(type="collection")
     *
     * @CustomAssert\BestMoveGuess
     */
    protected $guess = [];

    /**
     * Sets position
     *
     * @param int $position
     *
     * @return self
     */
    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Gets position
     *
     * @return int $position
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Sets guess
     *
     * @param array $guess
     *
     * @return self
     */
    public function setGuess(array $guess): self
    {
        $this->guess = $guess;

        return $this;
    }

    /**
     * Gets guess
     *
     * @return array $guess
     */
    public function getGuess(): array
    {
        return $this->guess;
    }
}
