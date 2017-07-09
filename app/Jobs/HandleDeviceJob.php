<?php

namespace App\Jobs;

use App\Control\Unice\SDK\Device\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class HandleDeviceJob
 * @package App\Jobs
 */
class HandleDeviceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var object
     */
    protected $device;

    /**
     * Create a new job instance.
     *
     * @param object $device
     *
     */
    public function __construct($device)
    {
        $this->device = $device;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Device::getByUid($this->device->uid)->handleDevice($this->device);
    }
}
