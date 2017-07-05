<?php

namespace App\Control\Unice\SDK\Message;

/**
 * Created by PhpStorm.
 * User: btica
 * Date: 08/06/2017
 * Time: 17:53
 */
use App\Control\Unice\SDK\Message\Payload\Payload;
use App\Control\Unice\SDK\Unice\Unice;

/**
 * Class MessageAbstract
 * @package App\Control\WebSocket\Message
 */
abstract class MessageAbstract
{
    /**
     * Message Structure
     * todo implement a validation
     */
    const MESSAGE_STRUCTURE = [
        'code' => 'required',
        'receiver' => 'string',
        'sender' => 'string|uid',
        'payload' => 'object|required'
    ];

    /**
     * @var string
     */

    protected $sender;

    /**
     * @var string
     */
    protected $receiver;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Payload
     */
    protected $payload;


    public function getSender()
    {
        return $this->sender;
    }

    public function getReceiver()
    {
        return $this->receiver;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * MessageAbstract constructor.
     * @param $message
     */
    function __construct($message)
    {
        if (is_string($message)) {
            $message = (object)json_decode($message);
        }

        $this->type = $message->type;
        $this->receiver = $message->receiver;
        $this->sender = $message->sender;
        $this->payload = new Payload($this->payload);

    }

    /**
     * @param $message
     * @return static
     */
    public static function make($message)
    {
        return (new static($message));
    }

    /**
     * @return string
     */
    function __toString()
    {
        return json_encode((object)[
            'type' => $this->type,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'payload' => $this->payload
        ]);
    }
}