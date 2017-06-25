<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 06/06/2017
 * Time: 21:05
 */

namespace App\Control\WebSocket\Server;


use App\Control\Unice\SDK\Message\Message;
use App\Control\Unice\SDK\Unice\Unice;
use App\Models\Unice\MapUniceType;
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

    /**
     * @var string
     */
    protected $channel = 'lobby';

    /**
     * @var Unice
     */
    protected $unice;

    /**
     * @var bool
     */
    protected $type = false;
    /**
     * @var bool
     */
    protected $uid = false;

    /**
     * @param Server $source
     * @param Message $message
     * @param Collection $nodes
     * @return bool
     */
    public function join(Server $source, Message $message, Collection $nodes)
    {
        $unice = Unice::getByUid($message->sender, false);

        if (!$unice) {
            $this->reject($source, 'Invalid UID');
            return false;
        }

        $this->unice = $unice;

        $this->type = $this->unice->getType();

        switch ($this->type) {
            //base appplication
            case MapUniceType::UNICE_BASE:
                $receiverId = $message->receiver;
                $this->channel = 'channel-' . $receiverId;
                $this->uid = $message->sender;
                break;
            //for all unices
            default:
                $this->channel = 'channel-' . $message->sender;
                $this->uid = $message->sender;
                break;
        }

        dump('Joined ' . $this->uid . ' to ' . $this->channel);
        return $this->getUid();
    }

    public function reject(Server $source, string $message = 'Rejected')
    {
        $source->close(
            Connection::CLOSE_NORMAL,
            $message
        );
    }

    /**
     * @return Unice
     */
    public function getUnice()
    {
        return $this->unice;
    }

    /**
     * @return bool
     */
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

    /**
     * @return bool
     */
    public function getType()
    {
        return $this->type;
    }

}