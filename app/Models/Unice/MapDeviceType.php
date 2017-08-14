<?php

namespace App\Models\Unice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapDeviceType extends Model 
{

    const DOUBLE = 10;

    const TRIPLE = 20;

    const QUADRUPLE = 30;

    const IMPULSE = 40;

    const PERCENTAGE = 50;

    const SENSOR = 60;



    protected $table = 'map_device_types';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('device_type', 'name');

    public function devices()
    {
        return $this->hasMany('App\Models\Unice\Device', 'device_type', 'device_type');
    }
}