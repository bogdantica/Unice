<?php
/**
 * Created by PhpStorm.
 * User: btica
 * Date: 07/06/2017
 * Time: 17:55
 */

namespace App\Control\Unice\SDK\Message;

use App\Control\Unice\SDK\Unice\Unice;
use App\Control\WebSocket\Server\UniceNode;
use Hoa\Websocket\Server;
use Illuminate\Support\Collection;

/**
 * Class Message
 * @package App\Control\Unice\SDK\Message
 */
class UniceMessage extends MessageAbstract
{
    const UID_CHECK = 100;
    const BASE_TO_UNICE = 200;
    const UNICE_TO_BASE = 250;

    protected $source;

    function __construct($message, Server $source = null)
    {
        parent::__construct($message);
        $this->source = $source;
    }

    /**
     * @param UniceNode $node
     * @param Collection $nodes
     */
    public function handle(UniceNode $node, Collection $nodes)
    {
        switch ($this->getType()) {
            case static::UID_CHECK:
                $node->join($this);
                break;
            default:
                $this->send($node, $nodes);
        }
    }

    /**
     * @param UniceNode $node
     * @param Collection $nodes
     */
    protected function send(UniceNode $node, Collection $nodes)
    {
        switch ($this->getType()) {

            case static::BASE_TO_UNICE:
                $this->toUnice($node, $nodes);
                break;

            case static::UNICE_TO_BASE:
                $this->toBase();
                break;

            default:
                $this->reject($node->getConnection());

        }
    }

    /**
     * @param UniceNode $node
     * @param Collection $nodes
     */
    protected function toUnice(UniceNode $node, Collection $nodes)
    {
        $nodes->each(function ($otherNode) {
            $this->source->send($this->__toString(), $otherNode);
        });
    }

    public function toBase()
    {
        Unice::getByUid(\App\Models\Unice\Unice::BASE_UID)//todo update this in order to solve dynamic
        ->handlePayload($this->getPayload());
    }

    /**
     * @param Server $conn
     */
    protected function reject(Server $conn)
    {
        $conn->close();
    }

}