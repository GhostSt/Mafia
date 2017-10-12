<?php

namespace GhostSt\CoreBundle\Service\Role;

use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRole;
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
     * @return UserRole[]
     */
    public function all()
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
    public function isCivilian(GamePlayerInterface $player)
    {
        $civilianRoles = $this->settingService->getByCode('civilian_roles');

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
    public function isMafia(GamePlayerInterface $player)
    {
        $mafiaRoles = $this->settingService->getByCode('mafia_roles');

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
