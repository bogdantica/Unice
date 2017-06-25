<?php

namespace App\Models\Unice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceState extends Model 
{

    protected $table = 'state_devices';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at','last_time_target_updated'];
    protected $fillable = array('device_id', 'state_current', 'state_target', 'state_target_real', 'last_time_target_updated', 'manual_control');

    public function device()
    {
        return $this->belongsTo('App\Models\Unice\Device', 'device_id');
    }

}