<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 11.03.17
 * Time: 23:58
 */

namespace GhostSt\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class UserRole
 * @package GhostSt\CoreBundle\Document
 *
 * @ODM\Document(collection="user_role")
 */
class UserRole
{
    /**
     * Player role id
     * @var string
     *
     * @ODM\Id(strategy="AUTO")
     */
    private $id;

    /**
     * Parent role
     *
     * @var UserRole
     *
     * @ODM\ReferenceOne(targetDocument="UserRole", storeAs="id")
     */
    protected $parent;
    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $name;

    public function __toString()
    {
        return $this->name;
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
     * Set parent
     *
     * @param UserRole $parent
     * @return $this
     */
    public function setParent(UserRole $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return UserRole $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
}
