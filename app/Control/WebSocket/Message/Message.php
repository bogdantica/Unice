<?php
/**
 * Created by PhpStorm.
 * User: btica
 * Date: 07/06/2017
 * Time: 17:55
 */

namespace App\Control\WebSocket\Message;

use App\Control\WebSocket\ChannelNode;
use App\Control\WebSocket\CommunicationServer;
use Hoa\Websocket\Connection;
use Hoa\Websocket\Server;
use Illuminate\Support\Collection;

class Message extends MessageAbstract
{
    /* First Message Validation */
    const UID_CHECK = 100;

    const APP_TO_UNICE_ID_CHECK_FAIL = 110; //and reject

    /* Messages from App to Device */
    const APP_TO_UNICE = 200;

    /* Messages from Device to App */
    const UNICE_TO_APP = 250;

    protected $attributes = [];


    public static function appToUniceIdCheckFail(Server $source, ChannelNode $node)
    {
        $source->close(
            Connection::CLOSE_NORMAL,
            'Invalid UID'
        );
        return;
    }

    public static function appToUnice(Server $source, ChannelNode $node, Collection $nodes, $message)
    {
        $payload = (object)[];

        $message = Message::make([
            'code' => Message::APP_TO_UNICE,
            'sender' => $node->getUid(),
            'payload' => $payload
        ]);

        $nodes->each(function ($otherNode) use ($node, $source, $message, $payload) {
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
        return true;
    }
}