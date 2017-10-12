<?php

namespace GhostSt\CoreBundle\Repository\Tools;

use GhostSt\CoreBundle\Document\Tools\SettingInterface;

/**
 * Setting repository interface
 */
interface SettingRepositoryInterface
{
    /**
     * Return setting by code
     *
     * @param $code
     *
     * @return null|SettingInterface
     */
    public function getByCode($code);

    /**
     * Return setting by id
     *
     * @param string $id
     *
     * @return null|SettingInterface
     */
    public function getById($id);

    /**
     * Finds unused settings
     *
     * @param array $settings
     *
     * @var SettingInterface[]
     */
    public function findUnusedSettings(array $settings);

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting);
}
