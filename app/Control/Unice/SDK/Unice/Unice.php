<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 25/06/2017
 * Time: 13:17
 */

namespace App\Control\Unice\SDK\Unice;


use Carbon\Carbon;

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
     * @param Unice $unice
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

        return \Cache::remember($cacheKey, 10, function () use ($uid) {
            $uniceModel = \App\Models\Unice\Unice::where('unice_uid', $uid)
                ->with('type')
                ->with('devices')
                ->with('devices.type')
                ->with('devices.state')
                ->first();

            return new Unice($uniceModel);
        });
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

    public function incomingMessage()
    {
        //todo add cache remove.make a notification. remove cache
        $this->uniceModel->last_reported = Carbon::now();
        $this->uniceModel->save();
    }
}