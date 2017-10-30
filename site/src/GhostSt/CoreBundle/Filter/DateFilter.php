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
 * Date filter
 */
class DateFilter implements DateFilterInterface
{
    /**
     * Filter code
     *
     * @var string
     */
    private $code;

    /**
     * Filter start date
     *
     * @var DateTime
     */
    private $from;

    /**
     * Filter end date
     *
     * @var DateTime
     */
    private $to;

    /**
     * Constructor
     *
     * @param string $code
     * @param string $from
     * @param string $to
     */
    public function __construct(string $code, string $from, string $to)
    {
        $this->code = $code;
        $this->from = new DateTime($from);
        $this->to   = new DateTime($to);
    }

    /**
     * Gets filter code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Gets start date filter
     *
     * @return DateTime
     */
    public function getFrom(): DateTime
    {
        return $this->from;
    }

    /**
     * Gets end date filter
     *
     * @return DateTime
     */
    public function getTo(): DateTime
    {
        return $this->to;
    }
}