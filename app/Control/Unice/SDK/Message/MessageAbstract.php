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
     * Message attributes haystack.
     * @var array
     */
    protected $attributes = [];

    /**
     * @var Unice
     */
    protected $unice;

    /**
     *
     * Setter method for message attributes
     * @param $name
     * @param $value
     * @return bool
     */
    function __set($name, $value)
    {
        return in_array($name, array_keys(static::MESSAGE_STRUCTURE)) ? $this->attributes[$name] = $value : false;
    }

    /**
     *
     * Getter method for message attributes
     * @param $name
     * @return null
     */
    function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * MessageAbstract constructor.
     * @param $message
     */
    function __construct($message)
    {
        if (is_string($message)) {
            $message = json_decode($message);
        }

        if (is_array($message) || is_object($message)) {
            $message = is_array($message) ? (object)$message : $message;
            foreach (array_keys(static::MESSAGE_STRUCTURE) as $name) {

                switch ($name) {
                    case 'payload':
//                        break;
                    default:
                        $this->$name = $message->$name ?? null;
                }
            }
            
            $this->unice = is_null($this->sender) ? null : Unice::getByUid($this->sender);
            return $this;
        }

        return false;
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
        return json_encode((object)$this->attributes);
    }

    /**
     * @param MessageAbstract $message
     * @return bool
     */
    public static function validateMessage(MessageAbstract $message)
    {
        //todo
        return true;
    }

    /**
     * @param $code
     * @param $sender
     * @param Payload $payload
     * @return object
     */
    public static function buildMessage($code, $sender, Payload $payload)
    {
        return (object)[
            'code' => $code,
            'sender' => $sender,
            'payload' => $payload
        ];
    }
}