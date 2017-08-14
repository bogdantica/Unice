<?php

namespace App\Models\Unice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{

    protected $table = 'devices';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'uid', 'unice_id', 'device_type');

    public function unice()
    {
        return $this->belongsTo(Unice::class, 'unice_id');
    }

    public function type()
    {
        return $this->belongsTo(MapDeviceType::class, 'device_type', 'device_type');
    }

    public function state()
    {
        return $this->hasOne(DeviceState::class, 'device_id', 'id')->orderBy('updated_at', 'DESC')->orderBy('created_at','DESC');
    }

    public function stateHistory()
    {
        return $this->hasMany(DeviceState::class, 'device_id', 'id')->orderBy('updated_at', 'DESC')->orderBy('created_at','DESC')->limit(10);
    }

}