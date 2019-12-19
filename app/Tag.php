<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
      'tag_type_id','name',
    ];

    public function tag_type()
    {
      return $this->belongsTo('App\TagType');
    }
    public function cv()
    {
      return $this->hasManyThough('App\CV','App\CV_tag');
    }
}
