<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $fillable=['title','description','distance'];
    
    public function towns(){
        return $this->hasMany('App\Town');
    }
    
    public function customers(){
        return $this->hasMany('App\Customer');
    }
}
