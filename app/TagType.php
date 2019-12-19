<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    protected $fillable = [
      'name',
    ];
    public function tags()
    {
      return $this->hasMany('App\Tag');
    }
}
