<?php

namespace App\Models;

use App\TiCTRL\DeviceNode;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'device_name',
        'device_token',
        'device_node'
    ];


    public static function pair($token, DeviceNode $node)
    {
        $device = (new static)->where('device_token', $token)->first();


        if ($device) {

            $node->setDeviceModel($device);

            $device->device_node = serialize($node);
        }

    }

    public function sendMessage($message)
    {
        $deviceNode = unserialize($this->device_node);
        $deviceNode->getConnection()->send($message);
    }
}
