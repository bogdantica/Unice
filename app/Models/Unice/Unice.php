<?php

namespace App\Models\Unice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unice extends Model 
{

    const BASE_UID = 'unice_base_nCsREAfm1jnfqDjXV+oS7wXcEpITpFEWhq7MtbEEXUA';

    protected $table = 'unices';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at','last_sync','last_reported'];
    protected $fillable = array('name', 'uid', 'online', 'unice_type_id', 'is_base', 'connection_uid');

//    public function type()
//    {
//        return $this->belongsTo('App\Models\Unice\MapUniceType', 'unice_type_id', 'unice_type_id');
//    }

    public function devices()
    {
        return $this->hasMany('App\Models\Unice\Device', 'unice_id', 'id');
    }

}