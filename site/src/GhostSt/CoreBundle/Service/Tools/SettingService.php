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
     * Setting repository
     *
     * @var SettingRepositoryInterface
     */
    private $settingRepository;

    /**
     * Constructor
     *
     * @param SettingRepositoryInterface $settingRepository
     */
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Returns setting
     *
     * @param string $code
     *
     * @return SettingInterface
     *
     * @throws RuntimeException
     */
    public function get($code)
    {
        try {
            return $this->settingRepository->get($code);
        } catch (NoResultException $exception) {
            throw new RuntimeException('Setting not found', 500);
        }
    }

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting)
    {
        $this->settingRepository->save($setting);
    }
}
