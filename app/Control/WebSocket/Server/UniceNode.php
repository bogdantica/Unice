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

/**
 * Class UniceNode
 * @package App\TiCTRL\WebSocket
 */
class UniceNode extends Node
{

    /**
     * @var string
     */
    protected $name = 'lobby';

    /**
     * @var Unice
     */
    protected $unice = false;

    /**
     * @var bool
     */
    protected $uid = false;

    /**
     * @param Server $source
     * @param Message $message
     * @return bool
     */
    public function join(Server $source, Message $message)
    {
        $unice = Unice::getByUid($message->getSender(), false);

        if (!$unice) {
            return $this->reject($source);
        }

        $this->setUnice($unice);

        switch ($this->getUniceType()) {
            case MapUniceType::UNICE_BASE:
                $this->joinNode($message->getReceiver(), $message->getSender());
                break;
            default:
                $this->joinNode($message->getSender(), $message->getSender());
                break;
        }

        return $this->getUid();
    }

    protected function joinNode(string $name, string $senderUid)
    {
        $this->name = 'node-' . $name;

        $this->uid = $senderUid;
    }

    protected function setUnice(Unice $unice)
    {
        $this->unice = $unice;

        return $this;
    }

    public function reject(Server $source, string $message = 'Rejected')
    {
        $source->close(
            Connection::CLOSE_NORMAL,
            $message
        );

        return true;
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
    public function getUniceType()
    {
        return $this->unice->getType();
    }

}