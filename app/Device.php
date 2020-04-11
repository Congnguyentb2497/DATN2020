<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $table = "device";
    public $timestamp = false;
    public function dv_type(){
    	return $this->belongsTo('App\Device_type','dv_type_id','id');
    }
    public function accessory(){
    	return $this->belongsToMany('App\Accessory','Device_accessory','dv_id','acc_id');
    }
    public function provider(){
    	return $this->belongsTo('App\Provider','provider_id','id');
    }
    public function department(){
    	return $this->belongsTo('App\Department', 'id', 'department_id');
    }
    
}
