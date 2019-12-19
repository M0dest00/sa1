<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV_Tag extends Model
{
  protected $fillable = ['cv_id','tag_id'];

  protected $table = 'cv_tags';

  public function cv()
  {
    return $this->belongsTo('App\CV');
  }
  public function tag()
  {
    return $this->belongsTo('App\Tag');
  }
}
