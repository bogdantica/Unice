<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 25/06/2017
 * Time: 12:04
 */

namespace App\Control\Unice\SDK\Message\Payload;


use App\Control\Unice\SDK\Device\Device;
use Illuminate\Support\Collection;

/**
 * Class Payload
 * @package App\Control\Unice\SDK\Message\Payload
 */
class Payload
{
    const PAYLOAD_STRUCTURE = [
//        'devices' => 'required|exists:unices,unice_uid',
        'devices.*.uid' => 'exists:devices,device_uid',
    ];

    /**
     * @var Collection
     */
    protected $devices;

    protected $commands;

    /**
     * Payload constructor.
     * @param string|array|object $payload
     */
    public function __construct($payload = null)
    {
        $this->devices = collect();
        $this->commands = collect();

        if (is_null($payload)) {
            return;
        }

        if (is_string($payload)) {
            $payload = json_decode($payload);
        }

        if (is_array($payload)) {
            $payload = (object)$payload;
        }

        //todo
//        $this->validate($payload);

        $this->devices = collect($payload->devices);

    }

    /**
     * @param Collection $commands
     * @return $this
     */
    public function addCommands(Collection $commands)
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }
        return $this;
    }

    /**
     * @param object $command
     * @return $this
     */
    public function addCommand(object $command)
    {
        $this->commands->push($command);
        return $this;
    }

    public function getDevices()
    {
        return $this->devices;
    }

    /**
     * @param Collection $devices
     * @return  $this
     */
    public function addDevices(Collection $devices)
    {
        foreach ($devices as $device) {
            $this->addDevice($device);
        }

        return $this;
    }

    /**
     * @param Device $device
     * @return $this
     */
    public function addDevice(Device $device)
    {
        $this->devices->put($device->getUid(), $device->asPayload());
        return $this;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return json_encode((object)[
            'devices' => $this->devices,
            'commands' => $this->commands,
        ]);
    }

    public function forMessage()
    {
        return (object)[
            'devices' => $this->devices,
            'commands' => $this->commands,
        ];
    }
}