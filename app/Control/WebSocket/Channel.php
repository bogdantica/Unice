<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 06/06/2017
 * Time: 21:24
 */

namespace App\Control\WebSocket;


use Hoa\Websocket\Node;
use Illuminate\Support\Collection;

class Channel
{
    protected $nodes;

    function __construct()
    {
        $this->nodes = new Collection();
    }

    public function pushNode(Node $node)
    {
        $this->nodes->push($node);
    }

    public function removeNode(Node $node)
    {
        $this->nodes = $this->nodes->filter(function($item) use ($node){
            return $node != $item;
        });
    }
}