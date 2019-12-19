<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = ['name', 'picture' , 'description'];

  public function questions()
  {
    return $this->hasMany('App\Question');
  }
  public function getPictureAttribute($value)
  {
    return asset('categories/'.$value);
  }

}
