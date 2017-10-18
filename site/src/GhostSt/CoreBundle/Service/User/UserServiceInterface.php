<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 17.10.17
 * Time: 0:24
 */
namespace GhostSt\CoreBundle\Service\User;

use GhostSt\CoreBundle\Document\User;

/**
 * User service interface
 */
interface UserServiceInterface
{
    /**
     * Gets list of users
     *
     * @return User[]
     */
    public function getList(): array;
}