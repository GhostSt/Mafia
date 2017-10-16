<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Role;

use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\Game\PlayerRoleInterface;
use GhostSt\CoreBundle\Repository\Game\PlayerRoleRepositoryInterface;
use GhostSt\CoreBundle\Service\Tools\SettingServiceInterface;

/**
 * Player role service
 */
class PlayerRoleService implements PlayerRoleServiceInterface
{
    /**
     * Setting service
     *
     * @var SettingServiceInterface
     */
    private $settingService;

    /**
     * Player role repository
     *
     * @var PlayerRoleRepositoryInterface
     */
    private $repository;

    /**
     * Constructor
     *
     * @param SettingServiceInterface       $settingService
     * @param PlayerRoleRepositoryInterface $playerRoleRepository
     */
    public function __construct(
        SettingServiceInterface $settingService,
        PlayerRoleRepositoryInterface $playerRoleRepository
    ) {
        $this->settingService = $settingService;
        $this->repository     = $playerRoleRepository;
    }

    /**
     * Gets player roles
     *
     * @return PlayerRoleInterface[]
     */
    public function all(): array
    {
        return $this->repository->all();
    }

    /**
     * Check if player is civilian
     *
     * @param GamePlayerInterface $player
     *
     * @return bool
     */
    public function isCivilian(GamePlayerInterface $player): bool
    {
        $setting = $this->settingService
            ->getByCode('mafia_roles');

        $civilianRoles = $setting->getValue();

        if (!is_array($civilianRoles)) {
            return false;
        }

        foreach ($civilianRoles as $roleId) {
            if ($player->getRole()->getId() === $roleId) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if player is mafia
     *
     * @param GamePlayerInterface $player
     *
     * @return bool
     */
    public function isMafia(GamePlayerInterface $player): bool
    {
        $setting = $this->settingService->getByCode('mafia_roles');

        $mafiaRoles = $setting->getValue();

        if (!is_array($mafiaRoles)) {
            return false;
        }

        foreach ($mafiaRoles as $roleId) {
            if ($player->getRole()->getId() === $roleId) {
                return true;
            }
        }

        return false;
    }
}
