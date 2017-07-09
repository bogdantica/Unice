<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 05/06/2017
 * Time: 18:55
 */

namespace App\Control\WebSocket\Server;

use App\Control\Unice\SDK\Message\UniceMessage;
use Hoa\Event\Bucket;
use Hoa\Websocket\Server;
use Tik\WebSocket\Server\WebSocketServerAbstract;

/**
 * Class ControlWs
 * @package App\TiCTRL\WebSocket
 */
class ControlWs extends WebSocketServerAbstract
{
    /**
     * DevicesServer constructor.
     * @param $protocol
     * @param $host
     * @param $port
     */
    function __construct($protocol = null, $host = null, $port = null)
    {
        parent::__construct($protocol, $host, $port);

        $this->server = new Server(
            new \Hoa\Socket\Server($this->getURI())
        );

        $this->server->on('open', [$this, 'onOpen']);
        $this->server->on('close', [$this, 'onClose']);
        $this->server->on('message', [$this, 'onMessage']);

        $this->server->getConnection()->setNodeName(UniceNode::class);
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
        try {
            $node = $event->getSource()->getConnection()->getCurrentNode();

            $unice = $node->getUnice();

            if ($unice) {
                $unice->offline();
            }
            dump('Closed: ', $node->getName());

        } catch (\Exception $e) {
            dump('Close', $e->getMessage());
        }
    }

    /**
     * @param Bucket $event
     */
    public static function onMessage(Bucket $event)
    {
        $connection = $event->getSource()->getConnection();
        $node = $connection->getCurrentNode();
        $nodes = collect($connection->getNodes())->reject($node);
        $message = $event->getData()['message'];

        try {

            dump($message);
            $message = new UniceMessage($message,$event->getSource());
            $message->handle($node, $nodes);

        } catch (\Exception $e) {
            dump('Message:', $e->getMessage());
        }
    }
}