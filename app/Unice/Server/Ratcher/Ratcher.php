<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 17/09/2017
 * Time: 21:14
 */

namespace App\Unice\Server\Ratcher;


use App\Unice\Server\Ratcher\Extended\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\Server;

class Ratcher
{
    protected $server;

    protected $socket;

    protected $loop;

    function __construct()
    {
        $this->loop = Factory::create();

        $this->socket = new Server($this->loop);

        $this->socket->listen(9875, '127.0.0.1');

        new IoServer(
            new HttpServer(
                new WsServer(
                    new Handler(
                        $this->loop
                    )
                )
            ),
            $this->socket
        );

    }


    public function handle()
    {
        $this->loop->run();
    }

}