<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.10.17
 * Time: 21:58
 */

declare(strict_types = 1);

namespace Tests\GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\User;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Rating\Strategy\MafiaStrategy;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;
use PHPUnit\Framework\TestCase;

class MafiaStrategyTest extends TestCase
{
    /**
     * Tests no rating return
     *
     * @param int  $gameResult
     * @param bool $mafiaRole
     *
     * @dataProvider noRatingDataProvider
     */
    public function testNoRating($gameResult, $mafiaRole)
    {
        $roleService = $this->createMock(PlayerRoleServiceInterface::class);
        $game        = $this->createMock(GameInterface::class);
        $player      = $this->createMock(GamePlayerInterface::class);

        $game
            ->method('getResult')
            ->willReturn($gameResult);

        $roleService
            ->method('isMafia')
            ->with($this->identicalTo($player))
            ->willReturn($mafiaRole);

        $mafiaStrategy = new MafiaStrategy($roleService);

        $this->assertEquals([], $mafiaStrategy->createRatings($game, $player));
    }

    /**
     * Tests successful rating creation
     */
    public function testCreateRating()
    {
        $roleService = $this->createMock(PlayerRoleServiceInterface::class);
        $game        = $this->createMock(GameInterface::class);
        $player      = $this->createMock(GamePlayerInterface::class);

        $game
            ->method('getResult')
            ->willReturn(GameInterface::WIN_MAFIA);

        $roleService
            ->method('isMafia')
            ->with($this->identicalTo($player))
            ->willReturn(true);


        $player
            ->expects($this->once())
            ->method('getUser')
            ->willReturn($user = $this->createMock(User::class));

        $user
            ->expects($this->once())
            ->method('getId')
            ->willReturn(123);

        $game
            ->expects($this->once())
            ->method('getId')
            ->willReturn(567);

        $mafiaStrategy = new MafiaStrategy($roleService);

        $ratings = $mafiaStrategy->createRatings($game, $player);

        $this->assertCount(1, $ratings);

        $this->assertEquals(123, $ratings[0]->getUserId());
        $this->assertEquals(567, $ratings[0]->getGameId());
        $this->assertEquals(UserRatingInterface::RATING_CODE_WIN_MAFIA, $ratings[0]->getCode());
        $this->assertEquals(GameInterface::WIN_SCORE_BONUS, $ratings[0]->getScore());
    }

    /**
     * Data provider that wont create Rating
     *
     * @return array
     */
    public function noRatingDataProvider()
    {
        return [
            [
                GameInterface::WIN_CIVILIAN,
                true,
            ],
            [
                GameInterface::WIN_CIVILIAN,
                false,
            ],
            [
                GameInterface::WIN_MAFIA,
                false,
            ],
        ];
    }
}