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

}