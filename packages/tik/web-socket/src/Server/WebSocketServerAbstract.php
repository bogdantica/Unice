<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 05/06/2017
 * Time: 18:26
 */

namespace Tik\WebSocket\Server;

abstract class WebSocketServerAbstract
{
    protected $protocol;
    protected $host;
    protected $port;

    protected $server;

    function __construct($protocol = null, $host = null, $port = null)
    {
        $this->protocol = is_null($protocol) ? config('control.uniceCommunication.connection.protocol', 'ws') : $protocol;
        $this->host = is_null($host) ? config('control.uniceCommunication.connection.host', '127.0.0.1') : $host;
        $this->port = is_null($port) ? config('control.uniceCommunication.connection.port', '98765') : $port;
    }

    public function getURI()
    {
        return $this->protocol . '://' . $this->host . ':' . $this->port;
    }

    public function run()
    {
        $this->server->run();
    }
}