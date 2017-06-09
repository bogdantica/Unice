<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 06/06/2017
 * Time: 21:05
 */

namespace App\Control\WebSocket\Server;


use App\Control\WebSocket\Message\Message;
use Hoa\Websocket\Connection;
use Hoa\Websocket\Node;
use Hoa\Websocket\Server;
use Illuminate\Support\Collection;

/**
 * Class ChannelNode
 * @package App\TiCTRL\WebSocket
 */
class ChannelNode extends Node
{
    const TYPES = [
        'unice', // Unice Device
        'app' //server application, that handle the control messages for Unice Devices...
    ];

    /**
     * @var string
     */
    protected $channel = 'default-channel';

    protected $type = false;
    protected $uid = false;

    public function join(Server $source, Message $message, Collection $nodes)
    {
//        $this->type = Unice::getTypeByUid($message->sender); //todo
        $this->type = $message->payload->type; //todo remove

        if (!$this->type) {
            return false;
        }

        switch ($this->type) {
            case false:
                $source->close(
                    Connection::CLOSE_NORMAL,
                    'Invalid uid'
                );
                return false;
                break;

            case 'app':
                $this->channel = 'channel-' . $message->payload->uniceId;
                $this->uid = 'app'; //todo hardcoded until future improvements.
                break;

            case 'unice':
                $this->channel = 'channel-' . $message->sender;
                $this->uid = $message->sender;
                break;

            default:
                $source->close(
                    Connection::CLOSE_NORMAL,
                    'Invalid type'
                );
        }

        //restricted just to 2 nodes per channel..
        $anotherNode = $nodes->first();
        return $this->getUid();
    }


    public function getUid()
    {
        return $this->uid;
    }

    /**
     *  Get Channel Name
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    public function getType()
    {
        return $this->type;
    }

}