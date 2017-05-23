<?php

namespace GhostSt\CoreBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use GhostSt\CoreBundle\Document\Game;
use GhostSt\CoreBundle\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute('_login');
    }

    /**
     * @Route("/queue")
     */
    public function queueAction()
    {

        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('test_queue', false, false, false, false);

        $msg = new AMQPMessage('Hello world '. date('Y-m-d H:i:s'));
        $channel->basic_publish($msg, '', 'test_queue');

        $channel->close();
        $connection->close();

        var_dump($_GET);
        /*
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');

        $channel = $connection->channel();
        $callback = function($msg) {
            echo " [x] Received ", $msg->body, "\n";
        };

        $channel->basic_consume('test_queue', '', false, true, false, false, $callback);

        while(count($channel->callbacks)) {
            $channel->wait();
        }
        */

        return new Response();
    }
}
