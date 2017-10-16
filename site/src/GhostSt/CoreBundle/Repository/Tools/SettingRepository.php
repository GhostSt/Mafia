<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 06.10.17
 * Time: 20:20
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Repository\Tools;

use Doctrine\ODM\MongoDB\Cursor;
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
     * @return null|SettingInterface
     */
    public function getByCode($code):? SettingInterface
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
     * @return null|SettingInterface
     */
    public function getById($id):? SettingInterface
    {
        return $this->getDocumentManager()
                    ->getRepository(Setting::class)
                    ->find($id);
    }

    /**
     * Finds used settings
     *
     * @param array $settings
     *
     * @return Cursor|SettingInterface[]
     */
    public function findUsedSettings(array $settings): Cursor
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
    public function save(SettingInterface $setting): void
    {
        $this->getDocumentManager()->persist($setting);
        $this->getDocumentManager()->flush($setting);
    }
}