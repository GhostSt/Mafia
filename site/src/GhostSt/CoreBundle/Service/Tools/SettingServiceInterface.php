<?php

namespace GhostSt\CoreBundle\Service\Tools;

use GhostSt\CoreBundle\Document\Tools\SettingInterface;

/**
 * Setting service interface
 */
interface SettingServiceInterface
{
    /**
     * Gets setting by code
     *
     * @param string $code
     *
     * @return SettingInterface
     */
    public function getByCode($code);

    /**
     * Gets setting by id
     *
     * @param string $id
     *
     * @return SettingInterface
     */
    public function getById($id);

    /**
     * Finds unused settings
     *
     * @var SettingInterface[]
     */
    public function findUnusedSettings();

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting);
}
