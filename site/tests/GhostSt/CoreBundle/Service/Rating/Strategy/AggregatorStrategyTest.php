<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.10.17
 * Time: 20:28
 */

declare(strict_types = 1);

namespace Tests\GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Rating\Strategy\AggregatorStrategy;
use GhostSt\CoreBundle\Service\Rating\Strategy\StrategyInterface;
use PHPUnit\Framework\TestCase;

/**
 * Test aggregator strategy
 */
class AggregatorStrategyTest extends TestCase
{
    /**
     * Test calling strategies and returned ratings
     */
    public function testCreateRatings()
    {
        $game   = $this->createMock(GameInterface::class);
        $player = $this->createMock(GamePlayerInterface::class);

        $someStrategy = $this->createMock(StrategyInterface::class);
        $someStrategy
            ->expects($this->once())
            ->method('createRatings')
            ->with(
                $this->identicalTo($game),
                $this->identicalTo($player)
            )
            ->willReturn([
                $rating1 = $this->createMock(UserRatingInterface::class),
                $rating2 = $this->createMock(UserRatingInterface::class),
            ]);

        $anotherStrategy = $this->createMock(StrategyInterface::class);
        $anotherStrategy
            ->expects($this->once())
            ->method('createRatings')
            ->with(
                $this->identicalTo($game),
                $this->identicalTo($player)
            )
            ->willReturn([$rating3 = $this->createMock(UserRatingInterface::class)]);

        $aggregator = new AggregatorStrategy();
        $aggregator->addStrategy($someStrategy);
        $aggregator->addStrategy($anotherStrategy);

        $ratings = $aggregator->createRatings($game, $player);

        $this->assertCount(3, $ratings);
        $this->assertContains($rating1, $ratings);
        $this->assertContains($rating2, $ratings);
        $this->assertContains($rating3, $ratings);
    }
}