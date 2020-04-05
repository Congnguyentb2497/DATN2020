<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Department extends Model
{
    //
    protected $table = 'department';
    protected $primaryKey = 'department_id';

    public function users()
    {
    	return $this->hasMany('App\User', 'department_id', 'department_id');
    }
}
