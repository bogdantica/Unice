<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 25/06/2017
 * Time: 12:27
 */

namespace App\Control\Unice\SDK\Device;


use App\Control\Unice\SDK\Unice\Unice;
use App\Jobs\UniceMessageJob;
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

    protected $unice;

    /**
     * Device constructor.
     * @param \App\Models\Unice\Device $deviceModel
     */
    public function __construct(\App\Models\Unice\Device $deviceModel)
    {
        $this->deviceModel = $deviceModel;
    }

    public static function getById(int $id)
    {
        return new static(\App\Models\Unice\Device::with('state')->find($id));
    }

    public function getUnice()
    {
        if (is_null($this->unice)) {
            $this->unice = new Unice($this->deviceModel->unice);
        }

        return $this->unice;
    }


    public static function getByUid(string $uid)
    {
        return new static(\App\Models\Unice\Device::where('device_uid', $uid)->with('state')->first());
    }

    public function getUid()
    {
        return $this->deviceModel->device_uid;
    }


    public function updateTarget($target)
    {
        $this->deviceModel->state->target = $target;

        $this->deviceModel->state->save();

        dispatch(new UniceMessageJob($this));

        return $this;
    }


    public function getState()
    {
        return $this->deviceModel->state;
    }

    public function handleDevice($device)
    {
        if (is_string($device)) {
            $device = json_decode($device);
        }

        if (isset($device->state)) {
            $this->deviceModel->state->state = $device->state->state;
        }

        $this->deviceModel->state->target = $device->state->target;

        $this->deviceModel->state->save();

        //todo add here a notification job
        return $this;
    }

    public
    function asPayload()
    {
        //todo send minim values.
        return (object)[
            'device' => $this->deviceModel ? $this->deviceModel->toArray() : null,
            'state' => $this->state ? $this->state->toArray() : null
        ];
    }

    function __toString()
    {
        //todo...
        return '';
    }
}