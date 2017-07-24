<?php

namespace App\Models\Unice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapDeviceType extends Model 
{

    const DOUBLE_POSITION = 10;

    const IMPULSE = 20;

    const SENSOR = 30;

    protected $table = 'map_device_types';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('device_type_id', 'type_name', 'type_display');

    public function devices()
    {
        return $this->hasMany('App\Models\Unice\Device', 'device_type_id', 'device_type_id');
    }
}