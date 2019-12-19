<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'short_name','nationality','country_code'];

    public function cv()
    {
      return $this->hasMany('App\CV');
    }
    public function city()
    {
      return $this->hasMany('App\City');
    }
}
