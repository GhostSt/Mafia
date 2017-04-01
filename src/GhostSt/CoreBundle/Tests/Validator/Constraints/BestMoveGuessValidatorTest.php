<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 01.04.17
 * Time: 14:29
 */

namespace GhostSt\CoreBundle\Tests\Validator\Constraints;

use GhostSt\CoreBundle\Validator\Constraints\BestMoveGuess;
use GhostSt\CoreBundle\Validator\Constraints\BestMoveGuessValidator;

class BestMoveGuessValidatorTest extends AbstractValidator
{
    CONST INVALID       = 'validator.constraints.best_move_guess.invalid';
    CONST COUNT         = 'validator.constraints.best_move_guess.count';
    CONST INVALID_VALUE = 'validator.constraints.best_move_guess.invalid_value';

    public function dataProvider()
    {
        return [
            [
                'value'  => [],
                'result' => false,
                'code'   => self::INVALID,
            ],
            [
                'value'  => 'test',
                'result' => false,
                'code'   => self::INVALID,
            ],
            [
                'value'  => new \stdClass(),
                'result' => false,
                'code'   => self::INVALID,
            ],
            [
                'value'  => [1, 3],
                'result' => false,
                'code'   => self::COUNT,
            ],
            [
                'value'  => [2, 7, 8, 15],
                'result' => false,
                'code'   => self::COUNT,
            ],
            [
                'value'  => [12, 7, 8],
                'result' => false,
                'code'   => self::INVALID_VALUE,
            ],
            [
                'value'  => [2, 17, 8],
                'result' => false,
                'code'   => self::INVALID_VALUE,
            ],
            [
                'value'  => [1, 7, 28],
                'result' => false,
                'code'   => self::INVALID_VALUE,
            ],
            [
                'value'  => [-61, 77, 28],
                'result' => false,
                'code'   => self::INVALID_VALUE,
            ],
            [
                'value'  => [5, 7, 8],
                'result' => true,
                'code'   => null,
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @param string $value
     * @param string $result
     * @param string $code
     */
    public function testValidate($value, $result, $code)
    {
        $translator = $this->getTranslatorMock($this, [
            self::INVALID,
            self::COUNT,
            self::INVALID_VALUE,
        ]);

        $validator = new BestMoveGuessValidator($translator);
        $validator->initialize($this->getContextMock());
        $validator->validate($value, $this->getConstraintMock(BestMoveGuess::class));

        $this->asserts($result, $code);
    }
}