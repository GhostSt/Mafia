<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.03.17
 * Time: 20:33
 */

namespace GhostSt\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class Vote
 * @package GhostSt\CoreBundle\Document
 *
 * @ODM\Document(collection="day_vote")
 */
class Vote
{
    /**
     * @var string
     *
     * @ODM\Id
     */
    protected $id;
    /**
     * @var integer
     *
     * @ODM\Field(type="integer")
     */
    protected $position;
    /**
     * @var
     *
     * @ODM\Field(type="integer")
     */
    protected $vote;
}