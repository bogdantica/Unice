<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 15/08/2017
 * Time: 22:10
 */

namespace App\Control\WebSocket\Server\Ratchet;


use Carbon\Carbon;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

/**
 * Class RatchetServer
 * @package App\Control\WebSocket\Server\Ratchet
 */
class RatchetServer implements MessageComponentInterface
{

    /**
     * @var \SplObjectStorage
     */
    protected $nodes;

    protected $command;

    /**
     * RatchetServer constructor.
     */
    function __construct()
    {
        $this->nodes = new \SplObjectStorage();


    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->nodes->attach($conn);

        $conn->joinTime = Carbon::now();

        echo "\nNew Connection:" . $conn->resourceId;
        echo "\nat: " . $conn->joinTime;

    }

    /**
     * @param ConnectionInterface $from
     * @param string $msg
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {

    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {
        $this->nodes->detach($conn);

        echo "\n\nLeaved Connection: " . $conn->resourceId;
        echo "\nat: " . Carbon::now();
        echo "\nThis resource joined: " . $conn->joinTime->diffForHumans();
        echo "\n\n";
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }
}