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

/**
 * General players statistic interface
 */
interface GeneralPlayersStatisticInterface
{
    /**
     * Calculates statistic
     *
     * @return array|RatingContainer[]
     */
    public function calculateStatistic(): array;
}