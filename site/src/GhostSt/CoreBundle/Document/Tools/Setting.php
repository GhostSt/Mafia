<?php

declare(strict_types = 1);

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
     * @var string
     *
     * @ODM\Id
     */
    private $id = '';

    /**
     * Code
     *
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $code = '';

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
    private $serialized = true;

    /**
     * Returns id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Sets code
     *
     * @param string|array $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Returns value
     *
     * @return null|string|array
     */
    public function getValue()
    {
        if ($this->serialized) {
            return json_decode($this->value);
        }

        return $this->value;
    }

    /**
     * Sets value
     *
     * @param string $value
     */
    public function setValue(string $value): void
    {
        if ($this->serialized) {
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
    public function isSerialized(): bool
    {
        return (bool) $this->serialized;
    }

    /**
     * Sets serialized
     *
     * @param bool $serialized
     */
    public function setSerialized(bool $serialized): void
    {
        $this->serialized = $serialized;
    }

}
