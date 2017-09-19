<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 18/09/2017
 * Time: 22:06
 */

namespace App\Unice\Server\Ratcher;


use App\Unice\Logic\Message;
use App\Unice\Server\Queue\Queue;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use React\EventLoop\StreamSelectLoop;

class Handler implements MessageComponentInterface
{
    protected $clients = [];

    function __construct(StreamSelectLoop $loop)
    {
        $loop->addPeriodicTimer(5, function () {
            $this->messagesQueue();
        });
        $this->clients = collect();
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->put($conn->uid, new Client($conn));
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        //todo update this
        if ($msg == 'auth') {
            return $this->auth($from, $msg);
        }

        $this->onClientMessage($this->clients[$from->uid], $msg);
    }

    protected function onClientMessage(Client $client, $msg)
    {
        $client->parseMessage($msg);
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        //todo
    }

    function onClose(ConnectionInterface $conn)
    {
//        $this->onClientClose($this->clients[$conn->uid]);
    }

    protected function onClientClose(Client $client)
    {
        $client->closed();
    }

    protected function welcome(ConnectionInterface $conn)
    {
        $this->guests->put($conn->resourceId, new Client($conn));
    }

    protected function auth(ConnectionInterface $conn, $message)
    {
        $message = new Message($message);

        $unice = $message->auth();

        $client = $this->pullClient($conn->uid);

        if (!is_null($unice)) {

            $client->setConn($conn)
                ->setType(Client::UNICE)
                ->setUid($unice->uid)
                ->setUnice($unice)
                ->send('Auth Success');

            $this->clients->put($client->getUid(), $client);

        } else {
            $client->close("Invalid Auth");
        }

        return $this;
    }

    /**
     * @param $uid
     * @return Client
     */
    protected
    function pullClient($uid)
    {
        return $this->clients->pull($uid);
    }

    protected function messagesQueue()
    {
        $messages = (new Queue())->pull(5);

        $messages->each(function (Message $msg) {
            if (isset($this->clients[$msg->uid])) {
                $this->clients[$msg->uid]->send(json_encode($msg));
            }
        });
    }

}
