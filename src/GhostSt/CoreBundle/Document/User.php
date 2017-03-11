<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 03.03.17
 * Time: 22:42
 */

namespace GhostSt\CoreBundle\Document;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 * @package GhostSt\CoreBundle\Entity
 *
 * @ODM\Document(collection="user")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ODM\Id(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $username;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $usernameCanonical;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $email;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $emailCanonical;

    /**
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
     * @var \DateTime
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
     * @var \DateTime
     */
    protected $passwordRequestedAt;

    /**
     * @var Collection
     */
    protected $groups = [];

    /**
     * @var Collection
     *
     * @ODM\Field(type="collection")
     */
    protected $roles;
    /**
     * @var \DateTime
     *
     * @ODM\Field(type="date")
     */
    protected $created;

    public function __construct()
    {
        parent::__construct();

        $this->created = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get enabled
     *
     * @return boolean $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
