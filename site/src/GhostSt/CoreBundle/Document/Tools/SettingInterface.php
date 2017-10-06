<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Document\Tools;

/**
 * Setting interface
 */
interface SettingInterface
{
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
