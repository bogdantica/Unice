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
    protected $ipDomain;
    protected $port;

    protected $server;

    function __construct($protocol, $ipDomain, $port)
    {
        $this->protocol = $protocol;
        $this->ipDomain = $ipDomain;
        $this->port = $port;
    }

    public function getURI()
    {
        return $this->protocol . '://' . $this->ipDomain . ':' . $this->port;
    }

    public function run()
    {
        $this->server->run();
    }
}