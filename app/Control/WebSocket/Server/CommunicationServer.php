<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 05/06/2017
 * Time: 18:55
 */

namespace App\Control\WebSocket\Server;

use App\Control\WebSocket\Message\Message;
use Hoa\Event\Bucket;
use Hoa\Socket\Connection\Connection;
use Hoa\Websocket\Server;
use Illuminate\Support\Collection;
use Tik\WebSocket\Server\WebSocketServerAbstract;

/**
 * Class DevicesServer
 * @package App\TiCTRL\WebSocket
 */
class CommunicationServer extends WebSocketServerAbstract
{
    /**
     * DevicesServer constructor.
     * @param $protocol
     * @param $ipDomain
     * @param $port
     */
    function __construct($protocol = null, $ipDomain = null, $port = null)
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
        try {
            $source = $event->getSource();
            $connection = $event->getSource()->getConnection();
            $node = $connection->getCurrentNode();
            $nodes = (new Collection($connection->getNodes()))->reject(function ($item) use ($node) {
                return $node == $item; //other nodes...
            });
            static::parseMessageEvent($source, $connection, $node, $nodes, $event->getData()['message']);
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
        }
    }

    /**
     * @param Server $source
     * @param Connection $connection
     * @param ChannelNode $node
     * @param Collection $nodes
     * @param string $message
     * @return mixed
     */
    public static function parseMessageEvent(Server $source, Connection $connection, ChannelNode $node, Collection $nodes, string $message)
    {
        $message = new Message($message);

        if (!Message::validateMessage($message)) {
            return false;
        }

        switch ($message->code) {

            case Message::UID_CHECK:
                //join node to channel and send a response code.
                return $node->join($source, $message, $nodes);
                break;
            case Message::APP_TO_UNICE:
                Message::appToUnice($source, $node, $nodes, $message);
                break;

            case Message::UNICE_TO_APP:
                Message::uniceToApp($source, $node, $nodes, $message);
                break;

            default:
                $source->close();
        }
        return false;
    }

    /**
     * @param Server $source
     * @param $message
     * @param ChannelNode|null $node
     * @return mixed
     */
    public static function send(Server $source, Message $message, ChannelNode $node = null)
    {
        return $source->send((string)$message, $node) ?? false;
    }

}