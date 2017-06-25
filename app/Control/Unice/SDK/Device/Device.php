<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 25/06/2017
 * Time: 12:27
 */

namespace App\Control\Unice\SDK\Device;


use App\Models\Unice\DeviceState;

class Device
{
    /**
     * @var \App\Models\Unice\Device
     */
    protected $deviceModel;

    /**
     * @var DeviceState
     */
    protected $state;

    /**
     * Device constructor.
     * @param \App\Models\Unice\Device $deviceModel
     */
    public function __construct(\App\Models\Unice\Device $deviceModel)
    {
        $this->deviceModel = $deviceModel;
    }


    public function getUid()
    {
        return $this->deviceModel->device_uid;
    }

    public function asPayload()
    {
        return (object)[
            'device' => $this->deviceModel->toArray(),
            'state' => $this->state->toArray()
        ];
    }

    function __toString()
    {
        //todo...
        return '';
    }
}