<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.10.17
 * Time: 21:58
 */

namespace Tests\GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\User;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Rating\Strategy\CivilianStrategy;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;
use PHPUnit\Framework\TestCase;

class CivilianStrategyTest extends TestCase
{
    /**
     * Tests no rating return
     *
     * @param int  $gameResult
     * @param bool $civilianRole
     *
     * @dataProvider noRatingDataProvider
     */
    public function testNoRating($gameResult, $civilianRole)
    {
        $roleService = $this->createMock(PlayerRoleServiceInterface::class);
        $game        = $this->createMock(GameInterface::class);
        $player      = $this->createMock(GamePlayerInterface::class);

        $game
            ->method('getResult')
            ->willReturn($gameResult);

        $roleService
            ->method('isCivilian')
            ->with($this->identicalTo($player))
            ->willReturn($civilianRole);

        $civilianStrategy = new CivilianStrategy($roleService);

        $this->assertEquals([], $civilianStrategy->createRatings($game, $player));
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
            ->willReturn(GameInterface::WIN_CIVILIAN);

        $roleService
            ->method('isCivilian')
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

        $civilianStrategy = new CivilianStrategy($roleService);

        $ratings = $civilianStrategy->createRatings($game, $player);

        $this->assertCount(1, $ratings);

        $this->assertEquals(123, $ratings[0]->getUserId());
        $this->assertEquals(567, $ratings[0]->getGameId());
        $this->assertEquals(UserRatingInterface::RATING_CODE_WIN_CIVILIAN, $ratings[0]->getCode());
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
                GameInterface::WIN_MAFIA,
                true,
            ],
            [
                GameInterface::WIN_MAFIA,
                false,
            ],
            [
                GameInterface::WIN_CIVILIAN,
                false,
            ],
        ];
    }
}