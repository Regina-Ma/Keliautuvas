<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $fillable=['name','surname','email','phone','country_id'];
    
    public function country(){
        return $this->belongsTo('App\Country');
    }
}
