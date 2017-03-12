<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.03.17
 * Time: 23:09
 */

namespace GhostSt\CoreBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GameBestMove
 * @package GhostSt\CoreBundle\Document
 *
 * @ODM\EmbeddedDocument
 */
class GameBestMove
{
    /**
     * @var integer
     *
     * @ODM\Field(type="integer")
     */
    protected $position;
    /**
     * @var array
     *
     * @ODM\Field(type="collection")
     */
    protected $guess = [];

    /**
     * Set position
     *
     * @param integer $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return integer $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set guess
     *
     * @param array $guess
     * @return $this
     */
    public function setGuess($guess)
    {
        $this->guess = $guess;
        return $this;
    }

    /**
     * Get guess
     *
     * @return array $guess
     */
    public function getGuess()
    {
        return $this->guess;
    }
}
