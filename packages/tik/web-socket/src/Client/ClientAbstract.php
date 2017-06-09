<?php
/**
 * Created by PhpStorm.
 * User: btica
 * Date: 09/06/2017
 * Time: 11:32
 */

namespace Tik\WebSocket\Client;


use Hoa\Websocket\Client;

/**
 * Class ClientAbstract
 * @package App\Control\WebSocket\Client
 */
class ClientAbstract
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
     * @var Client
     */
    protected $client;

    /**
     * ClientAbstract constructor.
     * @param string $protocol
     * @param string $host
     * @param string $port
     */
    public function __construct($protocol = null, $host = null, $port = null)
    {
        $this->protocol = is_null($protocol) ? config('control.uniceCommunication.connection.protocol', 'ws') : $protocol;
        $this->host = is_null($host) ? config('control.uniceCommunication.connection.host', '127.0.0.1') : $host;
        $this->port = is_null($port) ? config('control.uniceCommunication.connection.port', '9876') : $port;
    }

    /**
     * @return string
     */
    public function getURI()
    {
        return $this->protocol . '://' . $this->host . ':' . $this->port;
    }

}