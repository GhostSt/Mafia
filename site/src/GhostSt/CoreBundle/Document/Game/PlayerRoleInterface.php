<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 16.10.17
 * Time: 18:45
 */

namespace GhostSt\CoreBundle\Document\Game;

/**
 * Player role interface
 */
interface PlayerRoleInterface
{
    /**
     * Gets player role id
     *
     * @return string $id
     */
    public function getId(): string;

    /**
     * Gets parent role
     *
     * @return self
     */
    public function getParent(): self;

    /**
     * Gets name
     *
     * @return string $name
     */
    public function getName(): string;
}