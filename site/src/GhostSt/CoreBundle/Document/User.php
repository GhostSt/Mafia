<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 03.03.17
 * Time: 22:42
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ODM\Document(collection="user")
 */
class User extends BaseUser
{
    /**
     * User identifier
     *
     * @var string
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * Username
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $username;

    /**
     * Canonical username
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $usernameCanonical;

    /**
     * Email
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $email;

    /**
     * Canonical email
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $emailCanonical;

    /**
     * Enabled
     *
     * @var bool
     *
     * @ODM\Field(type="boolean")
     */
    protected $enabled;

    /**
     * The salt to use for hashing.
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $salt;

    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $password;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * Last login date
     *
     * @var DateTime
     *
     * @ODM\Field(type="date")
     */
    protected $lastLogin;

    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @var string
     */
    protected $confirmationToken;

    /**
     * @var DateTime
     */
    protected $passwordRequestedAt;

    /**
     * Groups
     *
     * @var Collection
     */
    protected $groups = [];

    /**
     * Roles
     *
     * @var Collection
     *
     * @ODM\Field(type="collection")
     */
    protected $roles;

    /**
     * Created
     *
     * @var DateTime
     *
     * @ODM\Field(type="date")
     */
    protected $created;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->created = new \DateTime();
    }

    /**
     * Gets created date
     *
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * Sets created date
     *
     * @param DateTime $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * User identifier
     *
     * @return null|string
     */
    public function getId():? string
    {
        return $this->id;
    }

    /**
     * Get enabled
     *
     * @return bool $enabled
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }
}
