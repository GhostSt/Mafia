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
     * Gets setting by code
     *
     * @param string $code
     *
     * @return null|SettingInterface
     */
    public function getByCode($code):? SettingInterface;

    /**
     * Gets setting by id
     *
     * @param string $id
     *
     * @return SettingInterface
     */
    public function getById($id):? SettingInterface;

    /**
     * Finds unused settings
     *
     * @return  SettingInterface[]
     */
    public function findUnusedSettings(): array;

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting): void;
}
