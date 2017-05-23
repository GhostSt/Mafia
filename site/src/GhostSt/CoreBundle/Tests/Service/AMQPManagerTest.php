<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 23.05.17
 * Time: 0:10
 */
namespace GhostSt\CoreBundle\Tests\Service;

use GhostSt\CoreBundle\Exception\AMQPException;
use GhostSt\CoreBundle\Service\AMQPManager;

class AMQPManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testChannelException()
    {
        self::expectException(AMQPException::class);

        $AMQPManager = new AMQPManager('host', 'port', 'guest', 'guest');
        $AMQPManager->declareQueue('test');
    }

    public function testBasicPublishException()
    {
        self::expectException(AMQPException::class);

        $AMQPManager = new AMQPManager('host', 'port', 'guest', 'guest');
        $AMQPManager->basicPublish();
    }

    public function testCloseChannelException()
    {
        self::expectException(AMQPException::class);

        $AMQPManager = new AMQPManager('host', 'port', 'guest', 'guest');
        $AMQPManager->closeChannel();
    }

    public function testCloseConnectionException()
    {
        self::expectException(AMQPException::class);

        $AMQPManager = new AMQPManager('host', 'port', 'guest', 'guest');
        $AMQPManager->closeConnection();
    }

    public function testGetChannelException()
    {
        self::expectException(AMQPException::class);

        $AMQPManager = new AMQPManager('host', 'port', 'guest', 'guest');
        $AMQPManager->getChannel();
    }
}