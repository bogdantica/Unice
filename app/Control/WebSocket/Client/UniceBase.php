<?php
/**
 * Created by PhpStorm.
 * User: btica
 * Date: 09/06/2017
 * Time: 11:33
 */

namespace App\Control\WebSocket\Client;


use App\Control\Unice\SDK\Message\MessageAbstract;
use App\Control\Unice\SDK\Message\UniceMessage;
use Hoa\Websocket\Client;
use Tik\WebSocket\Client\ClientAbstract;

class UniceBase extends ClientAbstract
{

    public function __construct($protocol = null, $host = null, $port = null)
    {
        $protocol = is_null($protocol) ? config('control.uniceCommunication.connection.protocol', 'ws') : $protocol;
        $host = is_null($host) ? config('control.uniceCommunication.connection.host', '127.0.0.1') : $host;
        $port = is_null($port) ? config('control.uniceCommunication.connection.port', '9876') : $port;

        parent::__construct($protocol, $host, $port);
    }

    public function newConnection()
    {
        if ($this->client) {
            $this->client->close();
        }

        $this->client = new  Client(
            new \Hoa\Socket\Client($this->getURI())
        );

        $this->client->setHost($this->host);

        $this->client->connect();

        return $this;
    }

    public function send(MessageAbstract $message)
    {
        $this->newConnection();

        $authMessage = new UniceMessage([
            'type' => UniceMessage::UID_CHECK,
            'sender' => \App\Models\Unice\Unice::BASE_UID,
            'receiver' => $message->getReceiver(),
        ]);

        $this->client->send($authMessage->__toString());

        //todo check if is kicked out
        if (!$this->client) {
            return false;
        }

        $this->client->send($message->__toString());

        $this->client->close();
        return true;
    }

    public static function sendNow(MessageAbstract $message)
    {
        return (new static())->send($message);
    }

}