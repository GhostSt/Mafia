<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Tools;

use GhostSt\CoreBundle\Document\Tools\SettingInterface;

/**
 * Setting service interface
 */
interface SettingServiceInterface
{
    /**
     * Return setting
     *
     * @param string $code
     *
     * @return SettingInterface
     */
    public function get($code);

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting);
}
