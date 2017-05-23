<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 01.04.17
 * Time: 14:50
 */

namespace GhostSt\CoreBundle\Tests\Validator\Constraints;

use GhostSt\CoreBundle\Document\User;
use GhostSt\CoreBundle\Validator\Constraints\Player;
use GhostSt\CoreBundle\Validator\Constraints\PlayerValidator;

class PlayerValidatorTest extends AbstractValidator
{
    CONST INVALID = 'validator.constraints.player.invalid';

    public function dataProvider()
    {
        return [
            [
                'value'  => null,
                'result' => false,
                'code'   => self::INVALID,
            ],
            [
                'value'  => 'test',
                'result' => false,
                'code'   => self::INVALID,
            ],
            [
                'value'  => new User(),
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
        $translator = $this->getTranslatorMock($this, [self::INVALID]);
        $constraint = $this->getConstraintMock(Player::class);

        $validator = new PlayerValidator($translator);
        $validator->initialize($this->getContextMock());
        $validator->validate($value, $constraint);

        $this->asserts($result, $code);
    }
}