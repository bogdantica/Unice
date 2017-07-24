<?php

namespace App\Control\Unice\SDK\Message;

/**
 * Created by PhpStorm.
 * User: btica
 * Date: 08/06/2017
 * Time: 17:53
 */
use App\Control\Unice\SDK\Message\Payload\Payload;
use Hoa\Websocket\Server;

/**
 * Class MessageAbstract
 * @package App\Control\WebSocket\Message
 */
abstract class MessageAbstract
{
    /**
     *
     */
    const UID_CHECK = 100;
    /**
     *
     */
    const BASE_TO_UNICE = 200;
    /**
     *
     */
    const UNICE_TO_BASE = 250;

    /**
     * Message Structure
     * todo implement a validation
     */
    const MESSAGE_STRUCTURE = [
        'type' => 'required',
        'sender' => 'required|string|exists:unices,unice_uid',
        'receiver' => 'nullable|string|exists:unices,unice_uid',
        'payload' => 'nullable'
    ];

    /**
     * @var Server
     */
    protected $source;

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


    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Payload
     */
    public function getPayload()
    {
        return $this->payload;
    }


    /**
     * MessageAbstract constructor.
     * @param $message
     * @param Server|null $source
     */
    function __construct($message, Server $source = null)
    {
        $this->source = $source;
        $this->parseMessage($message);
    }

    /**
     * @param $message
     */
    protected function parseMessage($message)
    {
        if (is_string($message)) {
            $message = json_decode($message);
        }

        $this->validateMessage($message);

        if (is_array($message)) {
            $message = (object)$message;
        }

        $this->type = $message->type;
        $this->sender = $message->sender;
        $this->receiver = $message->receiver ?? null;

        if (isset($message->payload)) {
            $this->payload = new Payload($message->payload);
        }

    }

    /**
     * @param $message
     * @return bool
     * @throws \Exception
     */
    protected function validateMessage($message)
    {
        $validation = \Validator::make((array)$message, static::MESSAGE_STRUCTURE);

        if ($validation->fails()) {
            dump($validation->errors()->toArray());
            throw new \Exception('Invalid Message');
        }

        return true;
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
            'payload' => $this->payload ? $this->payload->forMessage() : null
        ]);
    }
}