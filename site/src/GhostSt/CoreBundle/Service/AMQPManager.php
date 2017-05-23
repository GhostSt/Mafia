<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 22.05.17
 * Time: 13:13
 */
namespace GhostSt\CoreBundle\Service;

use GhostSt\CoreBundle\Exception\AMQPException;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AMQPManager
{
    /**
     * @var AMQPStreamConnection
     */
    protected $connection;
    /**
     * @var string
     */
    protected $host;
    /**
     * @var integer
     */
    protected $port;
    /**
     * @var string
     */
    protected $user;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $queue;
    /**
     * @var AMQPChannel
     */
    protected $channel;
    /**
     * @var AMQPMessage
     */
    protected $message;

    /**
     * AMQPManager constructor.
     *
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     */
    public function __construct($host, $port, $user, $password)
    {
        $this->host     = $host;
        $this->port     = $port;
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * @param string $message
     * @param array  $properties
     *
     * @return $this
     */
    public function setMessage($message, array $properties = [])
    {
        $this->message = new AMQPMessage(json_encode($message), $properties);

        return $this;
    }

    /**
     * @return $this
     * @throws AMQPException
     */
    public function getChannel()
    {
        if (null === $this->connection) {
            throw new AMQPException('Connection hasn\'t been set!', 500);
        }

        $this->channel = $this->connection->channel();

        return $this;
    }

    public function createConnection()
    {
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);
    }

    /**
     * @param mixed $queue
     *
     * @return $this
     * @throws AMQPException
     */
    public function declareQueue(
        $queue,
        $passive = false,
        $durable = false,
        $exclusive = false,
        $auto_delete = true,
        $nowait = false,
        $arguments = null,
        $ticket = null
    ) {
        if (null === $this->channel) {
            throw new AMQPException('Channel hasn\'t been set!', 500);
        }

        $this->queue = $queue;

        $this->channel->queue_declare(
            $queue,
            $passive,
            $durable,
            $exclusive,
            $auto_delete,
            $nowait,
            $arguments,
            $ticket

        );

        return $this;
    }

    /**
     * @param string $exchange
     * @param bool   $mandatory
     * @param bool   $immediate
     * @param null   $ticket
     *
     * @return $this
     * @throws AMQPException
     */
    public function basicPublish($exchange = '', $mandatory = false, $immediate = false, $ticket = null)
    {
        if (null === $this->message) {
            throw new AMQPException('Message has\'t been set!', 500);
        }

        $this->channel->basic_publish(
            $this->message,
            $exchange,
            $routing_key = $this->queue,
            $mandatory,
            $immediate,
            $ticket
        );

        return $this;
    }

    /**
     * @throws AMQPException
     *
     * @return $this
     */
    public function closeChannel()
    {
        if (null === $this->channel) {
            throw new AMQPException('Channel hasn\'t been set!', 500);
        }

        $this->channel->close();

        return $this;
    }

    /**
     * @return $this
     * @throws AMQPException
     */
    public function closeConnection()
    {
        if (null === $this->connection) {
            throw new AMQPException('Connection hasn\'t been set!', 500);
        }

        $this->connection->close();

        return $this;
    }
}