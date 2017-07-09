<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 25/06/2017
 * Time: 13:17
 */

namespace App\Control\Unice\SDK\Unice;


use App\Control\Unice\SDK\Message\Payload\Payload;
use App\Jobs\HandleDeviceJob;

/**
 * Class Unice
 * @package App\Control\Unice\SDK\Unice
 */
class Unice
{
    /**
     * @var \App\Models\Unice\Unice
     */
    protected $uniceModel;

    /**
     * Unice constructor.
     * @param \App\Models\Unice\Unice $unice
     */
    public function __construct(\App\Models\Unice\Unice $unice)
    {
        $this->uniceModel = $unice;
    }

    /**
     * @param string $uid
     * @param bool $cache
     * @return $this
     */
    public static function getByUid(string $uid, bool $cache = true)
    {
        $cacheKey = 'unice_model_uid_' . $uid;

        if (!$cache) {
            \Cache::forget($cacheKey);
        }

        $uniceModel = \App\Models\Unice\Unice::where('unice_uid', $uid)
            ->with('type')
            ->with('devices')
            ->with('devices.type')
            ->with('devices.state');

        dump($uid);

        return new Unice($uniceModel->first());

//        return \Cache::remember($cacheKey, 10, function () use ($uniceModel) {
//            return new Unice($uniceModel->first());
//        });
    }

    public function getType()
    {
        return $this->uniceModel->unice_type_id;
    }

    public function getUid()
    {
        return $this->uniceModel->unice_uid;
    }

    public function offline()
    {
        //todo add cache remove.make a notification. remove cache
        $this->uniceModel->online = false;
        $this->uniceModel->save();
    }

    public function online()
    {
        $this->uniceModel->online = true;
        $this->uniceModel->save();
        return $this;
    }

    /**
     * @param Payload $payload
     * @return $this
     */
    public function handlePayload(Payload $payload)
    {
        $payload->getDevices()->each(function ($device) {
            dispatch(new HandleDeviceJob($device));
        });

        //todo handle this payload...
        //make a notification

        return $this;

    }
}