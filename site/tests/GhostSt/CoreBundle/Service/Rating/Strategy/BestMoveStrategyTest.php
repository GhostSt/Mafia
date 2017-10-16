<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 12.10.17
 * Time: 20:44
 */

declare(strict_types = 1);

namespace Tests\GhostSt\CoreBundle\Service\Rating\Strategy;

use GhostSt\CoreBundle\Document\GameBestMoveInterface;
use GhostSt\CoreBundle\Document\GameInterface;
use GhostSt\CoreBundle\Document\GamePlayerInterface;
use GhostSt\CoreBundle\Document\User;
use GhostSt\CoreBundle\Document\UserRatingInterface;
use GhostSt\CoreBundle\Service\Rating\Strategy\BestMoveStrategy;
use GhostSt\CoreBundle\Service\Role\PlayerRoleServiceInterface;
use PHPUnit\Framework\TestCase;

/**
 * Test best move strategy
 */
class BestMoveStrategyTest extends TestCase
{
    /**
     * Tests that o rating will be returned if guess isn't belong to player
     */
    public function testNoRatingIfGuessNoBelongToPlayer()
    {
        $roleService = $this->createMock(PlayerRoleServiceInterface::class);
        $game        = $this->createMock(GameInterface::class);
        $player      = $this->createMock(GamePlayerInterface::class);
        $player
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(1);

        $game
            ->expects($this->once())
            ->method('getBestMove')
            ->willReturn($bestMove = $this->createMock(GameBestMoveInterface::class));

        $bestMove
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(6);

        $bestMoveStrategy = new BestMoveStrategy($roleService);

        $ratings = $bestMoveStrategy->createRatings($game, $player);

        $this->assertEmpty($ratings);
    }

    /**
     * Tests that no rating will be returned
     *
     * @dataProvider noRatingDataProvider
     */
    public function testNoRatingReturned(array $guess)
    {
        $roleService = $this->createMock(PlayerRoleServiceInterface::class);
        $game        = $this->createMock(GameInterface::class);
        $player1     = $this->createMock(GamePlayerInterface::class);
        $player2     = $this->createMock(GamePlayerInterface::class);
        $player3     = $this->createMock(GamePlayerInterface::class);
        $player4     = $this->createMock(GamePlayerInterface::class);
        $player5     = $this->createMock(GamePlayerInterface::class);
        $player6     = $this->createMock(GamePlayerInterface::class);
        $player7     = $this->createMock(GamePlayerInterface::class);
        $player8     = $this->createMock(GamePlayerInterface::class);
        $player9     = $this->createMock(GamePlayerInterface::class);
        $player10    = $this->createMock(GamePlayerInterface::class);

        $game
            ->expects($this->exactly(2))
            ->method('getBestMove')
            ->willReturn($bestMove = $this->createMock(GameBestMoveInterface::class));

        $bestMove
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(1);

        $player1
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(1);

        $roleService
            ->expects($this->at(1))
            ->method('isMafia')
            ->willReturn(true);

        $roleService
            ->expects($this->at(3))
            ->method('isMafia')
            ->willReturn(true);

        $roleService
            ->expects($this->at(4))
            ->method('isMafia')
            ->willReturn(true);

        $player2
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(2);

        $player4
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(4);

        $player5
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(5);

        $game
            ->expects($this->once())
            ->method('getPlayers')
            ->willReturn([
                $player1,
                $player2,
                $player3,
                $player4,
                $player5,
                $player6,
                $player7,
                $player8,
                $player9,
                $player10,
            ]);

        $bestMove
            ->expects($this->once())
            ->method('getGuess')
            ->willReturn($guess);

        $player1
            ->expects($this->never())
            ->method('getUser');

        $bestMoveStrategy = new BestMoveStrategy($roleService);

        $ratings = $bestMoveStrategy->createRatings($game, $player1);

        $this->assertEmpty($ratings);
    }

    /**
     * Tests create rating
     *
     * @param float $score
     * @param array $guess
     *
     * @dataProvider scoreRatingDataProvider
     */
    public function testReturnRatingScore(array $guess, $score)
    {
        $roleService = $this->createMock(PlayerRoleServiceInterface::class);
        $game        = $this->createMock(GameInterface::class);
        $player1     = $this->createMock(GamePlayerInterface::class);
        $player2     = $this->createMock(GamePlayerInterface::class);
        $player3     = $this->createMock(GamePlayerInterface::class);
        $player4     = $this->createMock(GamePlayerInterface::class);
        $player5     = $this->createMock(GamePlayerInterface::class);
        $player6     = $this->createMock(GamePlayerInterface::class);
        $player7     = $this->createMock(GamePlayerInterface::class);
        $player8     = $this->createMock(GamePlayerInterface::class);
        $player9     = $this->createMock(GamePlayerInterface::class);
        $player10    = $this->createMock(GamePlayerInterface::class);

        $game
            ->expects($this->exactly(2))
            ->method('getBestMove')
            ->willReturn($bestMove = $this->createMock(GameBestMoveInterface::class));

        $bestMove
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(1);

        $player1
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(1);

        $roleService
            ->expects($this->at(1))
            ->method('isMafia')
            ->willReturn(true);

        $roleService
            ->expects($this->at(3))
            ->method('isMafia')
            ->willReturn(true);

        $roleService
            ->expects($this->at(4))
            ->method('isMafia')
            ->willReturn(true);

        $player2
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(2);

        $player4
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(4);

        $player5
            ->expects($this->once())
            ->method('getPosition')
            ->willReturn(5);

        $game
            ->expects($this->once())
            ->method('getPlayers')
            ->willReturn([
                $player1,
                $player2,
                $player3,
                $player4,
                $player5,
                $player6,
                $player7,
                $player8,
                $player9,
                $player10,
            ]);

        $bestMove
            ->expects($this->once())
            ->method('getGuess')
            ->willReturn($guess);

        $player1
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

        $bestMoveStrategy = new BestMoveStrategy($roleService);

        $ratings = $bestMoveStrategy->createRatings($game, $player1);

        $this->assertCount(1, $ratings);

        $this->assertEquals(123, $ratings[0]->getUserId());
        $this->assertEquals(567, $ratings[0]->getGameId());
        $this->assertEquals(UserRatingInterface::RATING_CODE_WIN_BEST_MOVE, $ratings[0]->getCode());
        $this->assertEquals($score, $ratings[0]->getScore());
    }

    /**
     * Returns wrong guess
     *
     * @return array
     */
    public function noRatingDataProvider()
    {
        return [
            [
                // No matches
                [1, 3, 6],
            ],
            [
                [7, 3, 10],
            ],
            [
                [9, 7, 6],
            ],
            [
                [8, 3, 10],
            ],
            [
                [6, 9, 1],
            ],
            [
                [10, 8, 7],
            ],
            [
                [1, 2, 6],
            ],
            [
                [3, 5, 8],
            ],
            [
                [4, 1, 10],
            ],
            [
                [3, 4, 9],
            ],
        ];
    }

    /**
     * Returns guess set that will return rating
     *
     * @return array
     */
    public function scoreRatingDataProvider()
    {
        return [
            // Half score bonus
            [
                [2, 5, 7],
                GameBestMoveInterface::BEST_MOVE_HALF_BONUS,
            ],
            [
                [1, 4, 2],
                GameBestMoveInterface::BEST_MOVE_HALF_BONUS,
            ],
            [
                [8, 4, 2],
                GameBestMoveInterface::BEST_MOVE_HALF_BONUS,
            ],
            [
                [10, 2, 5],
                GameBestMoveInterface::BEST_MOVE_HALF_BONUS,
            ],
            [
                [7, 5, 4],
                GameBestMoveInterface::BEST_MOVE_HALF_BONUS,
            ],
            // Full score bonus
            [
                [2, 4, 5],
                GameBestMoveInterface::BEST_MOVE_FULL_BONUS,
            ],
            [
                [4, 2, 5],
                GameBestMoveInterface::BEST_MOVE_FULL_BONUS,
            ],
            [
                [5, 2, 4],
                GameBestMoveInterface::BEST_MOVE_FULL_BONUS,
            ],
            [
                [2, 5, 4],
                GameBestMoveInterface::BEST_MOVE_FULL_BONUS,
            ],
        ];
    }
}