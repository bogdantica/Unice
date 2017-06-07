<?php
/**
 * Created by PhpStorm.
 * User: btica
 * Date: 07/06/2017
 * Time: 17:55
 */

namespace App\Control\WebSocket\LookUps;


class MessageTypes
{
    /* Channel Nodes */

    const ACCEPTED_TO_CHANNEL = 100;

    const REQUEST_JOIN_TO_CHANNEL = 110;

    const ALREADY_TO_CHANNEL = 120;

    const REMOVED_FROM_CHANNEL = 130;

    /* Messages from App to Device */
    const APP_TO_DEVICE = 200;

    const APP_TO_DEVICE_ACCEPTED = 210;

    const APP_TO_DEVICE_REJECTED = 210;

    /* Messages from Device to App */
    const DEVICE_TO_APP = 250;

    const DEVICE_TO_APP_ACCEPTED = 260;

    const DEVICE_TO_APP_REJECTED = 260;

    //todo implementd and extend this...
    protected $messageStructure = [
        'code' => 'required',
        'channel' => 'string',
        'sender' => 'string|uid',
        'payload' => 'object|required'
    ];

}