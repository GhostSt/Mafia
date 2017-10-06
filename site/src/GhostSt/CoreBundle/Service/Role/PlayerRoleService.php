<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Role;

use GhostSt\CoreBundle\Document\GamePlayerInterface;
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
     * PlayerRoleService constructor.
     *
     * @param SettingServiceInterface $settingService
     */
    public function __construct(SettingServiceInterface $settingService)
    {
        $this->settingService = $settingService;
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
        $civilianRoles = $this->settingService->get('civilian_roles');

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
        $mafiaRoles = $this->settingService->get('mafia_roles');

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
