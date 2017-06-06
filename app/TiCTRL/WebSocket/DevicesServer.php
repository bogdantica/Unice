<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 05/06/2017
 * Time: 18:55
 */

namespace App\TiCTRL\WebSocket;

use Hoa\Event\Bucket;
use Hoa\Socket\Connection\Connection;
use Hoa\Websocket\Server;
use Illuminate\Support\Collection;
use Tik\WebSocket\Server\WebSocketServerAbstract;

/**
 * Class DevicesServer
 * @package App\TiCTRL\WebSocket
 */
class DevicesServer extends WebSocketServerAbstract
{

    /**
     *  CODES
     */
    const ACCEPTED_TO_CHANNEL = 100;
    const ALREADY_TO_CHANNEL = 120;

    /**
     * DevicesServer constructor.
     * @param $protocol
     * @param $ipDomain
     * @param $port
     */
    function __construct($protocol, $ipDomain, $port)
    {
        parent::__construct($protocol, $ipDomain, $port);

        $this->server = new \Hoa\Websocket\Server(
            new \Hoa\Socket\Server($this->getURI())
        );

        $this->server->on('open', [$this, 'onOpen']);
        $this->server->on('close', [$this, 'onClose']);
        $this->server->on('message', [$this, 'onMessage']);

        $this->server->getConnection()->setNodeName(ChannelNode::class);

    }

    /**
     * @param Bucket $event
     */
    public static function onOpen(Bucket $event)
    {

    }

    /**
     * @param Bucket $event
     */
    public static function onClose(Bucket $event)
    {
        //todo notify app that a device is down..
    }

    /**
     * @param Bucket $event
     */
    public static function onMessage(Bucket $event)
    {
        $source = $event->getSource();
        $connection = $event->getSource()->getConnection();
        $node = $connection->getCurrentNode();
        $nodes = new Collection($connection->getNodes());
        static::parseMessageEvent($source, $connection, $node, $nodes, $event->getData()['message']);
    }

    /**
     * @param Server $source
     * @param Connection $connection
     * @param ChannelNode $node
     * @param Collection $nodes
     * @param string $message
     */
    public static function parseMessageEvent(Server $source, Connection $connection, ChannelNode $node, Collection $nodes, string $message)
    {
        $message = json_decode($message);

        switch (true) {
            //todo break cases this by a set of codes.
            case !empty($message->channel):
                //join node to channel and send a response code.
                $response = static::joinChannel($node, $message->channel);
                static::send($source, $response, $node);

                break;

            case !empty($message->listeners->message):
                //answer to others nodes from channel.
                foreach ($nodes as $otherNode) {
                    if ($node != $otherNode) {
                        $redirect = (object)[
                            'channel' => $node->channel,
                            'message' => $message->listeners->message
                        ];
                        static::send($source, $redirect, $otherNode);
                    }
                }
                break;
            default:
                static::send($source, 'mesaj', $node);
        }
    }

    /**
     * @param Server $source
     * @param $message
     * @param ChannelNode|null $node
     * @return mixed
     */
    public static function send(Server $source, $message, ChannelNode $node = null)
    {
        return $source->send(json_encode($message), $node);
    }

    /**
     * @param ChannelNode $node
     * @param string $channel
     * @return object
     */
    public static function joinChannel(ChannelNode &$node, string $channel)
    {
        if ($node->channel != $channel) {
            $node->channel = $channel;

            $response = (object)[
                'channel' => $channel,
                'code' => static::ACCEPTED_TO_CHANNEL
            ];
        } else {
            $response = (object)[
                'channel' => $channel,
                'code' => static::ALREADY_TO_CHANNEL
            ];
        }

        return $response;
    }

}