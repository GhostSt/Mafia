<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Tools;

use GhostSt\CoreBundle\Document\Tools\SettingInterface;

/**
 * Setting repository interface
 */
interface SettingRepositoryInterface
{
    /**
     * Return setting
     *
     * @param $code
     *
     * @return null|SettingInterface
     */
    public function get($code);

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting);
}
