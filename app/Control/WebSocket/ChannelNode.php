<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 06/06/2017
 * Time: 21:05
 */

namespace App\Control\WebSocket;


use Hoa\Websocket\Node;

/**
 * Class ChannelNode
 * @package App\TiCTRL\WebSocket
 */
class ChannelNode extends Node
{
    /**
     * @var string
     */
    public $channel = 'default-channel';

    /**
     * Set Channel Name
     * @param string $channel
     */
    public function setChannel(string $channel)
    {
        $this->channel = $channel;
    }

    /**
     *  Get Channel Name
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }


}