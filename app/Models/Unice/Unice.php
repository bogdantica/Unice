<?php

namespace App\Models\Unice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unice extends Model 
{

    protected $table = 'unices';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('unice_name', 'unice_uid', 'online', 'unice_type_id');

    public function type()
    {
        return $this->belongsTo('App\Models\Unice\MapUniceType', 'unice_type_id', 'unice_type_id');
    }

    public function devices()
    {
        return $this->hasMany('App\Models\Unice\Device', 'unice_id', 'id');
    }

}