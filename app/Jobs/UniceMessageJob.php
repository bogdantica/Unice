<?php

namespace App\Jobs;

use App\Control\Unice\SDK\Device\Device;
use App\Control\Unice\SDK\Message\BaseMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class UniceMessageJob
 * @package App\Jobs
 */
class UniceMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Device
     */
    protected $device;

    /**
     * UniceMessageJob constructor.
     * @param Device $device
     */
    public function __construct(Device $device)
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
        BaseMessage::byDevice($this->device);
    }
}
