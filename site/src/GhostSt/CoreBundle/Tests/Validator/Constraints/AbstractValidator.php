<?php
/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 01.04.17
 * Time: 12:41
 */

namespace GhostSt\CoreBundle\Tests\Validator\Constraints;

use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilder;

class AbstractValidator extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $errorCode;

    /**
     * @return ExecutionContext
     */
    public function getContextMock()
    {
        $contextViolationBuilder = $this->getMockBuilder(ConstraintViolationBuilder::class)
                                        ->disableOriginalConstructor()
                                        ->setMethods(['addViolation'])
                                        ->getMock();

        $contextViolationBuilder
            ->expects($this->any())
            ->method('addViolation');

        $context = $this->getMockBuilder(ExecutionContext::class)
                        ->disableOriginalConstructor()
                        ->setMethods(['buildViolation'])
                        ->getMock();

        $context
            ->expects(self::atMost(1))
            ->method('buildViolation')
            ->will(self::returnValue($contextViolationBuilder));

        return $context;
    }

    public function getTranslatorMock($object, $codes)
    {
        $translator = $this->getMockBuilder(DataCollectorTranslator::class)
                           ->disableOriginalConstructor()
                           ->setMethods(['trans'])
                           ->getMock();

        $parameters = [];
        foreach ($codes as $code) {
            $parameters[] = self::equalTo($code);
        }

        $translator
            ->method('trans')
            ->with(self::logicalOr(...$parameters))
            ->will(self::returnCallback([$object, 'setCode']));

        return $translator;
    }

    public function getConstraintMock($class = null)
    {
        if (!$class) {
            $class = Constraint::class;
        }

        $constraint = $this->getMockBuilder($class)
                           ->disableOriginalConstructor()
                           ->getMock();

        return $constraint;
    }

    public function setCode($code)
    {
        $this->errorCode = $code;
    }

    protected function asserts($result, $code)
    {
        if ($result === true) {
            self::assertEmpty($this->errorCode, 'Actual validation result does not match to expected result');
        }

        if ($result === false) {
            self::assertEquals($this->errorCode, $code,
                'Actual validation error code does not match to expected error code');
        }
    }
}