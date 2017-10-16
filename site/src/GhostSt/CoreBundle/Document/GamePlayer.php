<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.03.17
 * Time: 22:28
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use GhostSt\CoreBundle\Document\Game\PlayerRole;
use GhostSt\CoreBundle\Document\Game\PlayerRoleInterface;
use GhostSt\CoreBundle\Validator\Constraints as CustomAssert;

/**
 * Game player
 *
 * @ODM\EmbeddedDocument
 */
class GamePlayer implements GamePlayerInterface
{
    /**
     * User
     *
     * @var User
     *
     * @ODM\ReferenceOne(targetDocument="User", storeAs="id")
     *
     * @CustomAssert\Player
     */
    protected $user;

    /**
     * Player role
     *
     * @var PlayerRoleInterface
     *
     * @ODM\ReferenceOne(targetDocument="GhostStCoreBundle:Game\PlayerRole", storeAs="id")
     *
     * @CustomAssert\Role
     */
    protected $role;

    /**
     * Position
     *
     * @var int
     *
     * @ODM\Field(type="integer")
     *
     * @CustomAssert\Position(
     *     allowZero=true
     * )
     */
    protected $position;

    /**
     * Sets user
     *
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Gets user
     *
     * @return User $user
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Sets role
     *
     * @param PlayerRoleInterface $role
     *
     * @return self
     */
    public function setRole(PlayerRoleInterface $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Gets role
     *
     * @return PlayerRoleInterface $role
     */
    public function getRole(): PlayerRoleInterface
    {
        return $this->role;
    }

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
     * Get position
     *
     * @return int $position
     */
    public function getPosition(): int
    {
        return $this->position;
    }
}
