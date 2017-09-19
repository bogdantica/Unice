<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 18/09/2017
 * Time: 22:35
 */

namespace App\Unice\Server\Ratcher\Extended;


use Ratchet\Server\IoConnection;

class IoServer extends \Ratchet\Server\IoServer
{
    CONST GUEST = 10;
    CONST UNICE = 20;

    /**
     * Triggered when a new connection is received from React
     * @param \React\Socket\ConnectionInterface $conn
     */
    public function handleConnect($conn)
    {
        $conn->decor = new IoConnection($conn);

        $conn->decor->resourceId = (int)$conn->stream;
        $conn->decor->remoteAddress = $conn->getRemoteAddress();

        $conn->decor->type = static::GUEST;
        $conn->decor->uid = $conn->decor->resourceId;

        $this->app->onOpen($conn->decor);

        $conn->on('data', $this->handlers[0]);
        $conn->on('end', $this->handlers[1]);
        $conn->on('error', $this->handlers[2]);
    }
}