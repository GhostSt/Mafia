<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Tools;

use Doctrine\ODM\MongoDB\Cursor;
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
    public function getByCode($code):? SettingInterface;

    /**
     * Return setting by id
     *
     * @param string $id
     *
     * @return null|SettingInterface
     */
    public function getById($id):? SettingInterface;

    /**
     * Finds used settings
     *
     * @param array $settings
     *
     * @return Cursor|SettingInterface[]
     */
    public function findUsedSettings(array $settings): Cursor;

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting): void;
}
