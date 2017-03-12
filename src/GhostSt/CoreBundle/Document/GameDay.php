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
     *
     * @ODM\Field(type="integer")
     */
    protected $killed;
    /**
     * @var integer
     *
     * @ODM\Field(type="integer")
     */
    protected $checkDon;
    /**
     * @var integer
     *
     * @ODM\Field(type="integer")
     */
    protected $checkSheriff;
    /**
     * @var array
     *
     * @ODM\Field(type="collection")
     */
    protected $voting;

    /**
     * Set killed
     *
     * @param integer $killed
     * @return $this
     */
    public function setKilled($killed)
    {
        $this->killed = $killed;
        return $this;
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
     * Set checkDon
     *
     * @param integer $checkDon
     * @return $this
     */
    public function setCheckDon($checkDon)
    {
        $this->checkDon = $checkDon;
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
     * Set checkSheriff
     *
     * @param integer $checkSheriff
     * @return $this
     */
    public function setCheckSheriff($checkSheriff)
    {
        $this->checkSheriff = $checkSheriff;
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
     * Set voting
     *
     * @param array $voting
     * @return $this
     */
    public function setVoting($voting)
    {
        $this->voting = $voting;
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
}
