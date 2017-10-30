<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 22.10.17
 * Time: 21:06
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Filter;

use DateTime;

/**
 * Date filter interface
 */
interface DateFilterInterface
{
    /**
     * Gets filter code
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Gets start date filter
     *
     * @return DateTime
     */
    public function getFrom(): DateTime;

    /**
     * Gets end date filter
     *
     * @return DateTime
     */
    public function getTo(): DateTime;
}