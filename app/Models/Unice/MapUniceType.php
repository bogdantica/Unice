<?php

namespace App\Models\Unice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapUniceType extends Model 
{

    protected $table = 'map_unice_types';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('unice_type_id', 'type_name', 'type_display');

    public function unices()
    {
        return $this->hasMany('App\Models\Unice\Unice', 'unice_type_id', 'unice_type_id');
    }

}