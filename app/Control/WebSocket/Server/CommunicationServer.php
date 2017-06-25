<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 05/06/2017
 * Time: 18:55
 */

namespace App\Control\WebSocket\Server;

use App\Control\Unice\SDK\Message\Message;
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
     * @param $host
     * @param $port
     */
    function __construct($protocol = null, $host = null, $port = null)
    {
        $protocol = is_null($protocol) ? config('control.uniceCommunication.connection.protocol', 'ws') : $protocol;
        $host = is_null($host) ? config('control.uniceCommunication.connection.host', '127.0.0.1') : $host;
        $port = is_null($port) ? config('control.uniceCommunication.connection.port', '98765') : $port;

        parent::__construct($protocol, $host, $port);

        $this->server = new Server(
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
        $node = $event->getSource()->getConnection()->getCurrentNode();

        $unice = $node->getUnice();

        if (!is_null($unice)) {
            $unice->closed();
        }
    }

    /**
     * @param Bucket $event
     */
    public static function onMessage(Bucket $event)
    {

        $source = $event->getSource();
        $connection = $source->getConnection();
        $node = $connection->getCurrentNode();
        $nodes = (new Collection($connection->getNodes()))->reject(function ($item) use ($node) {
            return $node == $item; //other nodes...
        });

        $message = $event->getData()['message'];

        try {

            static::parseMessageEvent($source, $connection, $node, $nodes, $message);

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
            $node->reject($source, 'Invalid Message');
            return false;
        }

        switch ($message->code) {
            case Message::UID_CHECK:
                return $node->join($source, $message, $nodes);
                break;
            case Message::BASE_TO_UNICE:
                Message::baseToUnice($source, $node, $nodes, $message);
                break;

            case Message::UNICE_TO_BASE:
                Message::uniceToApp($source, $node, $nodes, $message);
                break;

            default:
                $source->close(
                    \Hoa\Websocket\Connection::CLOSE_NORMAL,
                    'Invalid Message Type'
                );
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
        return $source->send($message->__toString(), $node) ?? false;
    }

}