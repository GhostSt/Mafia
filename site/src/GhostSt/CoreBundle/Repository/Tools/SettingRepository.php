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
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\NoResultException;
use GhostSt\CoreBundle\Document\Tools\Setting;
use GhostSt\CoreBundle\Document\Tools\SettingInterface;
use GhostSt\CoreBundle\Repository\AbstractRepository;

/**
 * Settings repository
 */
class SettingRepository extends AbstractRepository implements SettingRepositoryInterface
{
    /**
     * Return setting by code
     *
     * @param $code
     *
     * @return SettingInterface
     */
    public function getByCode($code)
    {
        return $this->getDocumentManager()
            ->getRepository(Setting::class)
            ->findOneBy(['code' => $code]);
    }

    /**
     * Return setting by id
     *
     * @param string $id
     *
     * @return SettingInterface
     */
    public function getById($id)
    {
        return $this->getDocumentManager()
                    ->getRepository(Setting::class)
                    ->find($id);
    }

    /**
     * Finds unused settings
     *
     * @param array $settings
     *
     * @return SettingInterface[]
     */
    public function findUnusedSettings(array $settings)
    {
        $qb = $this->getDocumentManager()
            ->createQueryBuilder(Setting::class);

        $qb->field('code')->in($settings);

        return $qb->getQuery()->execute();
    }

    /**
     * Saves setting
     *
     * @param SettingInterface $setting
     */
    public function save(SettingInterface $setting)
    {
        $this->getDocumentManager()->persist($setting);
        $this->getDocumentManager()->flush($setting);
    }
}