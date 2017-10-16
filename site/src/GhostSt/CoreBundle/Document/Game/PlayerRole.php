<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 11.03.17
 * Time: 23:58
 */

namespace GhostSt\CoreBundle\Document\Game;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Player role
 *
 * @ODM\Document(collection="user_role")
 */
class PlayerRole implements PlayerRoleInterface
{
    /**
     * Player role id
     *
     * @var string
     *
     * @ODM\Id(strategy="AUTO")
     */
    private $id;

    /**
     * Parent role
     *
     * @var self
     *
     * @ODM\ReferenceOne(targetDocument="PlayerRole", storeAs="id")
     */
    protected $parent;

    /**
     * Player role name
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $name;

    /**
     * Convert object to string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Gets player role id
     *
     * @return string $id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets parent role
     *
     * @param PlayerRoleInterface $parent
     *
     * @return self
     */
    public function setParent(PlayerRoleInterface $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Gets parent role
     *
     * @return PlayerRoleInterface
     */
    public function getParent(): PlayerRoleInterface
    {
        return $this->parent;
    }

    /**
     * Sets name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string $name
     */
    public function getName(): string
    {
        return $this->name;
    }
}
