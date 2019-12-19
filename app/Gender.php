<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $fillable = [
      'name',
    ];

    public function cv()
    {
      return $this->hasMany('App\CV');
    }
}
