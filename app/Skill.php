<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
      'name','description',
    ];

    public function cv()
    {
      return $this->hasManyThrough('App\CV','App\CV_Skill');
    }
}
