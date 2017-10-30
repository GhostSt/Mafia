<?php

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service\Sorter;

use GhostSt\CoreBundle\View\RatingContainer;

// TODO: covers by unit
/**
 * Sorter interface
 */
class RatingSorter implements SorterInterface
{
    /**
     * Sorts data
     *
     * @param array $data
     *
     * @return void
     */
    public function sort(array &$data): void
    {
        $this->sortByRating($data);
        $this->sortByGamesQuantity($data);

        krsort($data);

        $data = array_values($data);
    }

    /**
     * Sorts rating containers by rating
     *
     * @param array $data
     */
    private function sortByRating(array &$data): void
    {
        usort($data, function (RatingContainer $container, RatingContainer $nextContainer): int {
            if ($container->getRating() > $nextContainer->getRating()) {
                return 1;
            }

            return -1;
        });
    }

    /**
     * Sorts rating containers by games quantity
     *
     * @param array $data
     */
    private function sortByGamesQuantity(array &$data): void
    {
        usort($data, function (RatingContainer $container, RatingContainer $nextContainer): int {

            if ($container->getRating() === $nextContainer->getRating()) {
                return 0;
            }

            if ($container->getGamesQuantity() > $nextContainer->getGamesQuantity()) {
                return 1;
            }

            return -1;
        });
    }
}
