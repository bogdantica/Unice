<?php
/**
 * Created by PhpStorm.
 * User: btica
 * Date: 07/06/2017
 * Time: 17:55
 */

namespace App\Control\Unice\SDK\Message;

use App\Control\Unice\SDK\Device\Device;
use App\Control\Unice\SDK\Message\Payload\Payload;
use App\Control\WebSocket\Client\UniceBase;
use App\Models\Unice\Unice;

/**
 * Class Message
 * @package App\Control\Unice\SDK\Message
 */
class BaseMessage extends UniceMessage
{

    public static function byDevice(Device $device)
    {
        $payload = new Payload();

        $payload->addDevice($device);

        $message = new UniceMessage([
            'type' => UniceMessage::BASE_TO_UNICE,
            'sender' => Unice::BASE_UID,
            'receiver' => $device->getUnice()->getUid(),
            'payload' => $payload
        ]);

        UniceBase::sendNow($message);
    }

}