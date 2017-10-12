<?php

namespace GhostSt\CoreBundle\Document\Tools;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Setting
 *
 * @ODM\Document(collection="setting")
 */
class Setting implements SettingInterface
{
    /**
     * Id
     *
     * @var int
     *
     * @ODM\Id
     */
    private $id;

    /**
     * Code
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $code;

    /**
     * Value
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $value;

    /**
     * Serialized
     *
     * @var bool
     *
     * @ODM\Field(type="bool")
     */
    private $serialized;

    /**
     * Returns id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets code
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Returns value
     *
     * @return string
     */
    public function getValue()
    {
        if (true || $this->serialized) {
            return json_decode($this->value);
        }

        return $this->value;
    }

    /**
     * Sets value
     *
     * @param string $value
     */
    public function setValue($value)
    {
        if (true || $this->serialized) {
            $this->value = json_encode($value);

            return;
        }

        $this->value = $value;
    }

    /**
     * Check if setting value is json encoded string
     *
     * @return bool
     */
    public function isSerialized()
    {
        return (bool) $this->serialized;
    }

    /**
     * Sets serialized
     *
     * @param bool $serialized
     */
    public function setSerialized($serialized)
    {
        $this->serialized = $serialized;
    }

}
