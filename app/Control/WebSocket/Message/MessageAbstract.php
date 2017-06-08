<?php

namespace App\Control\WebSocket\Message;

/**
 * Created by PhpStorm.
 * User: btica
 * Date: 08/06/2017
 * Time: 17:53
 */
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
        'sender' => 'string|uid',
        'payload' => 'object|required'
    ];
    /**
     * Message attributes haystack.
     * @var array
     */
    protected $attributes = [];

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
                $this->$name = $message->$name ?? null;
            }
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
     * @param object $payload
     * @return object
     */
    public static function buildMessage($code, $sender, $payload = null)
    {
        return (object)[];
    }
}