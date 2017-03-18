<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 18.03.17
 * Time: 23:44
 */

namespace GhostSt\CoreBundle\Helper;

class PositionHelper
{
    /**
     * Gets list of positions
     *
     * @param int $start
     * @param int $end
     *
     * @return array
     */
    public static function getPositions($start, $end)
    {
        $positions = [];

        for ($i = $start; $i <= $end; $i++) {
            $positions[$i] = $i;
        }

        return $positions;
    }
}