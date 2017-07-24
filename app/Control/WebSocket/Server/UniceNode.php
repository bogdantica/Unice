<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 06/06/2017
 * Time: 21:05
 */

namespace App\Control\WebSocket\Server;


use App\Control\Unice\SDK\Message\UniceMessage;
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
     * @param UniceMessage $message
     * @return bool
     */
    public function join(UniceMessage $message)
    {
        $unice = Unice::getByUid($message->getSender(), false);

        if (!$unice) {
            return $this->reject();
        }

        $this->setUnice($unice);

        switch ($this->getUniceType()) {
            case MapUniceType::UNICE_BASE:
                $this->joinNode($message->getReceiver(), $message->getSender());
                break;
            default:
                $this->joinNode($message->getSender(), $message->getSender());
                $unice->online();
                break;
        }

        return $this->getUid();
    }

    /**
     * @param string $name
     * @param string $senderUid
     */
    protected function joinNode(string $name, string $senderUid)
    {
        $this->name = 'uniceDevice:' . $name;

        $this->uid = $senderUid;
    }

    /**
     * @param Unice $unice
     * @return $this
     */
    protected function setUnice(Unice $unice)
    {
        $this->unice = $unice;

        return $this;
    }

    /**
     * @param Connection|Server $source
     * @param string $message
     * @return bool
     */
    public function reject($source = null, string $message = 'Rejected')
    {
        if (is_null($source)) {
            $source = $this->getConnection();
        }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getUniceType()
    {
        return $this->unice->getType();
    }

}