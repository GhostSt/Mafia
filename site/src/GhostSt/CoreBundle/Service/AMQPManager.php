<?php

/**
 * Created by PhpStorm.
 * Author: Victor Diditskiy <victor.diditskiy@yandex.ru>
 * Date: 22.05.17
 * Time: 13:13
 */

declare(strict_types = 1);

namespace GhostSt\CoreBundle\Service;

use GhostSt\CoreBundle\Exception\AMQPException;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AMQPManager
{
    /**
     * AMQP Connection
     *
     * @var AMQPStreamConnection
     */
    protected $connection;

    /**
     * Host
     *
     * @var string
     */
    protected $host;

    /**
     * Port
     *
     * @var integer
     */
    protected $port;

    /**
     * User
     *
     * @var string
     */
    protected $user;

    /**
     * Password
     *
     * @var string
     */
    protected $password;

    /**
     * Queue
     *
     * @var string
     */
    protected $queue;

    /**
     * Channel
     *
     * @var AMQPChannel
     */
    protected $channel;

    /**
     * Message
     *
     * @var AMQPMessage
     */
    protected $message;

    /**
     * Constructor
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
     * Sets message
     *
     * @param string $message
     * @param array  $properties
     *
     * @return self
     */
    public function setMessage($message, array $properties = []): self
    {
        $this->message = new AMQPMessage(json_encode($message), $properties);

        return $this;
    }

    /**
     * Gets channel from connection
     *
     * @return self
     *
     * @throws AMQPException
     */
    public function getChannel(): self
    {
        if (null === $this->connection) {
            throw new AMQPException('Connection hasn\'t been set!', 500);
        }

        $this->channel = $this->connection->channel();

        return $this;
    }

    /**
     * Create connection
     */
    public function createConnection(): void
    {
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);
    }

    /**
     * Declares queue
     *
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
     * Sends message to queue
     *
     * @param string $exchange
     * @param bool   $mandatory
     * @param bool   $immediate
     * @param null   $ticket
     *
     * @return self
     *
     * @throws AMQPException
     */
    public function basicPublish($exchange = '', $mandatory = false, $immediate = false, $ticket = null): self
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
     * Closes channel
     *
     * @return self
     *
     * @throws AMQPException
     */
    public function closeChannel(): self
    {
        if (null === $this->channel) {
            throw new AMQPException('Channel hasn\'t been set!', 500);
        }

        $this->channel->close();

        return $this;
    }

    /**
     * Closes connection
     *
     * @return self
     *
     * @throws AMQPException
     */
    public function closeConnection(): self
    {
        if (null === $this->connection) {
            throw new AMQPException('Connection hasn\'t been set!', 500);
        }

        $this->connection->close();

        return $this;
    }
}