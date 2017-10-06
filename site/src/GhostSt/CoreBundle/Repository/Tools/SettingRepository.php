<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 06.10.17
 * Time: 20:20
 */

namespace GhostSt\CoreBundle\Repository\Tools;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use GhostSt\CoreBundle\Document\Tools\Setting;
use GhostSt\CoreBundle\Document\Tools\SettingInterface;

/**
 * Settings repository
 */
class SettingRepository implements SettingRepositoryInterface
{
    /**
     * Object manager
     *
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->manager = $managerRegistry->getManager();
    }

    /**
     * Return setting
     *
     * @param $code
     *
     * @return SettingInterface
     */
    public function get($code)
    {
        return $this->manager
            ->getRepository(Setting::class)
            ->findOneBy(['code' => $code]);
    }

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting)
    {
        $this->manager->persist($setting);
        $this->manager->flush($setting);
    }
}