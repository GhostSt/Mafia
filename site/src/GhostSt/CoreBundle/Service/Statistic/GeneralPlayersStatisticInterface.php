<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.10.17
 * Time: 23:45
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Statistic;

use GhostSt\CoreBundle\View\RatingContainer;
use GhostSt\CoreBundle\Filter\DateFilterInterface;

/**
 * General players statistic interface
 */
interface GeneralPlayersStatisticInterface
{
    /**
     * Calculates statistic
     *
     * @param DateFilterInterface $dateFilter
     *
     * @return array|RatingContainer[]
     */
    public function calculateStatistic(DateFilterInterface $dateFilter): array;
}