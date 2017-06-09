<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 05/06/2017
 * Time: 18:26
 */

namespace Tik\WebSocket\Server;

use Hoa\Websocket\Server;

/**
 * Class WebSocketServerAbstract
 * @package Tik\WebSocket\Server
 */
abstract class WebSocketServerAbstract
{
    /**
     * @var string
     */
    protected $protocol;
    /**
     * @var string
     */
    protected $host;
    /**
     * @var string
     */
    protected $port;

    /**
     * @var Server
     */
    protected $server;

    /**
     * WebSocketServerAbstract constructor.
     * @param string $protocol
     * @param string $host
     * @param string $port
     */
    public function __construct($protocol = 'ws', $host = '127.0.0.1', $port = '9876')
    {
        $this->protocol = $protocol;
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getURI()
    {
        return $this->protocol . '://' . $this->host . ':' . $this->port;
    }

    /**
     *
     */
    public function run()
    {
        $this->server->run();
    }
}