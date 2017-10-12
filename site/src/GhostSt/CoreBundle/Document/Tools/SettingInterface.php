<?php

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
     * @return int
     */
    public function getId();

    /**
     * Returns setting code
     *
     * @return string
     */
    public function getCode();

    /**
     * Return setting value
     *
     * @return string
     */
    public function getValue();

    /**
     * Check if setting value is json encoded string
     *
     * @return bool
     */
    public function isSerialized();
}
