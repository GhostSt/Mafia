<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document\Tools;

/**
 * Setting interface
 */
interface SettingInterface
{
    const SETTING_CIVILIAN_ROLES = 'civilian_roles';

    const SETTING_MAFIA_ROLES    = 'mafia_roles';

    /**
     * Returns setting id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Returns setting code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Returns setting value
     *
     * @return null|string|array
     */
    public function getValue();

    /**
     * Checks if setting value is json encoded string
     *
     * @return bool
     */
    public function isSerialized(): bool;
}
