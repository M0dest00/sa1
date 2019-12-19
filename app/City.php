<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  protected $fillable = [
    'name','country_id',
  ];

  public function country()
  {
    return $this->belongsTo('App\Country');
  }
  public function cv()
  {
    return $this->hasMany('App\CV');
  }
}
