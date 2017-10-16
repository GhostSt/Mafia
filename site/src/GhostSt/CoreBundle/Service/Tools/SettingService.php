<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Tools;

use RuntimeException;
use Doctrine\ORM\NoResultException;
use GhostSt\CoreBundle\Document\Tools\SettingInterface;
use GhostSt\CoreBundle\Repository\Tools\SettingRepositoryInterface;

/**
 * Setting service
 */
class SettingService implements SettingServiceInterface
{
    /**
     * Available settings
     *
     * @var array
     */
    private $settings;

    /**
     * Setting repository
     *
     * @var SettingRepositoryInterface
     */
    private $settingRepository;

    /**
     * Constructor
     *
     * @param SettingRepositoryInterface $settingRepository
     * @param array                      $settings
     */
    public function __construct(
        SettingRepositoryInterface $settingRepository,
        array $settings
    ) {
        $this->settingRepository = $settingRepository;
        $this->settings          = $settings;
    }

    /**
     * Returns setting
     *
     * @param string $code
     *
     * @return null|SettingInterface
     */
    public function getByCode($code):? SettingInterface
    {
        return $this->settingRepository->getByCode($code);
    }

    /**
     * Gets setting by id
     *
     * @param string $id
     *
     * @return null|SettingInterface
     */
    public function getById($id):? SettingInterface
    {
        return $this->settingRepository->getById($id);
    }

    /**
     * Finds unused settings
     *
     * @return array
     */
    public function findUnusedSettings(): array
    {
        $usedSettings     = $this->settingRepository->findUsedSettings($this->settings);
        $usedSettingCodes = [];

        foreach ($usedSettings as $setting) {
            $usedSettingCodes[] = $setting->getCode();
        }

        return array_diff($this->settings, $usedSettingCodes);
    }

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting): void
    {
        $this->settingRepository->save($setting);
    }
}
