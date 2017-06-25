<?php
/**
 * Created by PhpStorm.
 * User: btica
 * Date: 07/06/2017
 * Time: 17:55
 */

namespace App\Control\Unice\SDK\Message;

use App\Control\WebSocket\Server\ChannelNode;
use App\Control\WebSocket\Server\CommunicationServer;
use Hoa\Websocket\Connection;
use Hoa\Websocket\Server;
use Illuminate\Support\Collection;

class Message extends MessageAbstract
{
    /* First Message Validation */
    const UID_CHECK = 100;

    /* Messages from App to Device */
    const BASE_TO_UNICE = 200;
    const BASE_TO_ALL_UNICE = 210;

    /* Messages from Device to App */
    const UNICE_TO_BASE = 250;

    protected $attributes = [];


    public static function baseToUnice(Server $source, ChannelNode $node, Collection $nodes, Message $message)
    {
        $nodes->each(function ($otherNode) use ($node, $source, $message) {
            if ($otherNode != $node) {
                CommunicationServer::send(
                    $source,
                    $message,
                    $otherNode
                );
            }
        });

        return true;
    }

    public static function uniceToApp(Server $source, ChannelNode $node, Collection $nodes, $message)
    {
        $node->getUnice()->incomingMessage();
        return true;
    }
}