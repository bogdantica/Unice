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
use Hoa\Socket\Server as SocketServer;
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
            new SocketServer($this->getURI())
        );

        $this->server->on('close', [$this, 'onClose']);
        $this->server->on('message', [$this, 'onMessage']);

        $this->server->getConnection()->setNodeName(UniceNode::class);
    }

    /**
     * @param Bucket $event
     */
    public function onClose(Bucket $event)
    {
        try {
            $node = $event->getSource()->getConnection()->getCurrentNode();
            $unice = $node->getUnice();
            if ($unice) {
                $unice->offline();
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * @param Bucket $event
     */
    public function onMessage(Bucket $event)
    {
        $connection = $event->getSource()->getConnection();
        $node = $connection->getCurrentNode();
        $nodes = collect($connection->getNodes())->reject($node);
        $message = $event->getData()['message'];

        try {

            $message = new UniceMessage($message,$event->getSource());
            $message->handle($node, $nodes);

        } catch (\Exception $e) {
            dump('Message:', $e->getMessage());
        }
    }
}