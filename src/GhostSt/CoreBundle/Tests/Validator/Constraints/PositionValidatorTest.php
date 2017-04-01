<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 01.04.17
 * Time: 11:36
 */

namespace GhostSt\CoreBundle\Tests\Validator\Constraints;

use GhostSt\CoreBundle\Validator\Constraints\Position;
use GhostSt\CoreBundle\Validator\Constraints\PositionValidator;

class PositionValidatorTest extends AbstractValidator
{
    CONST IS_NUMERIC = 'validator.constraints.position.is_numeric';
    CONST RANGE      = 'validator.constraints.position.range';

    public function dataProvider()
    {
        return [
            [
                'value'     => 'test',
                'allowZero' => true,
                'result'    => false,
                'code'      => self::IS_NUMERIC,
            ],
            [
                'value'     => -1,
                'allowZero' => true,
                'result'    => false,
                'code'      => self::RANGE,
            ],
            [
                'value'     => 11,
                'allowZero' => true,
                'result'    => false,
                'code'      => self::RANGE,
            ],
            [
                'value'     => 0,
                'allowzero' => false,
                'result'    => false,
                'code'      => self::RANGE,
            ],
            [
                'value'     => 1,
                'allowZero' => true,
                'result'    => true,
                'code'      => null,
            ],
            [
                'value'     => 0,
                'allowzero' => true,
                'result'    => true,
                'code'      => null,
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     *
     * @param string  $value
     * @param boolean $allowZero
     * @param string  $result
     * @param string  $code
     */
    public function testValidate($value, $allowZero, $result, $code = null)
    {
        $translator = $this->getTranslatorMock($this, [self::IS_NUMERIC, self::RANGE]);
        $validator  = new PositionValidator($translator);
        $validator->initialize($this->getContextMock());

        $positionConstraintMock            = $this->getConstraintMock(Position::class);
        $positionConstraintMock->allowZero = $allowZero;
        $validator->validate($value, $positionConstraintMock);

        $this->asserts($result, $code);
    }
}