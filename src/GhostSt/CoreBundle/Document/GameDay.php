<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.03.17
 * Time: 22:11
 */

namespace GhostSt\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use GhostSt\CoreBundle\Validator\Constraints as CustomAssert;

/**
 * Class GameDay
 * @package GhostSt\CoreBundle\Document
 *
 * @ODM\EmbeddedDocument
 */
class GameDay
{
    /**
     * @var integer
     * @ODM\Field(type="integer")
     * @CustomAssert\Position(
     *     allowZero=false
     * )
     */
    protected $left;
    /**
     * @var integer
     *
     * @ODM\Field(type="integer")
     * @CustomAssert\Position(
     *     allowZero=false
     * )
     */
    protected $killed;
    /**
     * @var integer
     *
     * @ODM\Field(type="integer")
     * @CustomAssert\Position(
     *     allowZero=false
     * )
     */
    protected $checkDon;
    /**
     * @var integer
     *
     * @ODM\Field(type="integer")
     * @CustomAssert\Position(
     *     allowZero=false
     * )
     */
    protected $checkSheriff;
    /**
     * @var array
     *
     * @ODM\Field(type="collection")
     */
    protected $voting;

    /**
     * @return int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param int $left
     */
    public function setLeft($left)
    {
        $this->left = $left;
    }

    /**
     * Get killed
     *
     * @return integer $killed
     */
    public function getKilled()
    {
        return $this->killed;
    }

    /**
     * Set killed
     *
     * @param integer $killed
     *
     * @return $this
     */
    public function setKilled($killed)
    {
        $this->killed = $killed;

        return $this;
    }

    /**
     * Get checkDon
     *
     * @return integer $checkDon
     */
    public function getCheckDon()
    {
        return $this->checkDon;
    }

    /**
     * Set checkDon
     *
     * @param integer $checkDon
     *
     * @return $this
     */
    public function setCheckDon($checkDon)
    {
        $this->checkDon = $checkDon;

        return $this;
    }

    /**
     * Get checkSheriff
     *
     * @return integer $checkSheriff
     */
    public function getCheckSheriff()
    {
        return $this->checkSheriff;
    }

    /**
     * Set checkSheriff
     *
     * @param integer $checkSheriff
     *
     * @return $this
     */
    public function setCheckSheriff($checkSheriff)
    {
        $this->checkSheriff = $checkSheriff;

        return $this;
    }

    /**
     * Get voting
     *
     * @return array $voting
     */
    public function getVoting()
    {
        return $this->voting;
    }

    /**
     * Set voting
     *
     * @param array $voting
     *
     * @return $this
     */
    public function setVoting($voting)
    {
        $this->voting = $voting;

        return $this;
    }
}
