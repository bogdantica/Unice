<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 25/06/2017
 * Time: 12:04
 */

namespace App\Control\Unice\SDK\Message\Payload;


use App\Control\Unice\SDK\Device\Device;
use App\Control\Unice\SDK\Unice\Unice;
use Illuminate\Support\Collection;

/**
 * Class Payload
 * @package App\Control\Unice\SDK\Message\Payload
 */
class Payload
{

    /**
     *  Unice UID
     * @var string
     */
    protected $sender;


    /**
     * @var Collection
     */
    protected $devices;

    /**
     * @var Collection
     */
    protected $commands;

    /**
     * @var Unice
     */
    protected $unice;


    /**
     * Payload constructor.
     * @param $unice Unice
     */
    public function __construct(Unice $unice)
    {
        $this->unice = $unice;
        $this->sender = $unice->getUid();
        $this->devices = collect();
        $this->commands = collect();
        $this->extra = (object)[];
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

    public function getUnice()
    {
        return $this->unice;
    }

    public function getSender()
    {
        $this->sender;
    }


    /**
     * @return string
     */
    function __toString()
    {
        return json_encode((object)[
            'sender' => $this->sender,
            'devices' => $this->devices,
            'commands' => $this->commands,
        ]);
    }
}