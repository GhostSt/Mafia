<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Sorter;

/**
 * Sorter interface
 */
interface SorterInterface
{
    /**
     * Sorts data
     *
     * @param array $data
     *
     * @return void
     */
    public function sort(array &$data): void;
}
