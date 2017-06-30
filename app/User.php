<?php

namespace yuridik;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'firstName', 'lastName', 'city_id',
    ];

    public function city(){
    	return $this->hasOne('yuridik\City');
    }

    public function file(){
        return $this->morphOne('yuridik\File', 'fileable');
    }
}
