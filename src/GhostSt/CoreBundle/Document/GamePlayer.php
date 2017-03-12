<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.03.17
 * Time: 22:28
 */

namespace GhostSt\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GamePlayers
 * @package GhostSt\CoreBundle\Document
 *
 * @ODM\EmbeddedDocument
 */
class GamePlayer
{
    /**
     * @var User
     *
     * @ODM\ReferenceOne(targetDocument="User", storeAs="id")
     */
    protected $user;
    /**
     * @var UserRole
     *
     * @ODM\ReferenceOne(targetDocument="UserRole", storeAs="id")
     */
    protected $role;
    /**
     * @var
     *
     * @ODM\Field(type="integer")
     */
    protected $position;

    /**
     * Set user
     *
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set role
     *
     * @param UserRole $role
     * @return $this
     */
    public function setRole(UserRole $role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role
     *
     * @return UserRole $role
     */
    public function getRole()
    {
        return $this->role;
    }

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
}
