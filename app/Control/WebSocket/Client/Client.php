<?php
/**
 * Created by PhpStorm.
 * User: btica
 * Date: 09/06/2017
 * Time: 11:33
 */

namespace App\Control\WebSocket\Client;


use App\Control\WebSocket\Message\Message;
use App\Control\WebSocket\Message\MessageAbstract;
use Tik\WebSocket\Client\ClientAbstract;

class Client extends ClientAbstract
{

    public function __construct($protocol = null, $host = null, $port = null)
    {
        parent::__construct($protocol, $host, $port);
    }

    public function newConnection()
    {
        if ($this->client) {
            $this->client->close();
        }

        $this->client = new  \Hoa\Websocket\Client(
            new \Hoa\Socket\Client($this->getURI())
        );

        $this->client->setHost($this->host);

        $this->client->connect();

        return $this;
    }

    public function send(MessageAbstract $message, string $uniceId, string $sender = 'app')
    {
        $this->newConnection();
        //first send information in order to join the channel.
        $authMessage = new Message([
            'code' => Message::UID_CHECK,
            'sender' => $sender,
            'payload' => (object)[
                'type' => 'app', //temporary
                'uniceId' => $uniceId
            ]
        ]);
        //send a message in order to auth and join channel.
        $this->client->send((string)$authMessage);

        //if we are kicked out, return false.
        //todo update this in order to be valid.
        if (!$this->client) {
            return false;
        }

        //let's send message to channel
        $this->client->send((string)$message);

        $this->client->close();
        return true;
    }

    public static function fastSend(MessageAbstract $message,string $uniceId, string $sender = 'app')
    {
        return (new static())->send($message,$uniceId,$sender);
    }

}