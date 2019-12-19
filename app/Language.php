<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
   protected $fillable = [
     'language',
   ];

   public function cv()
   {
     return $this->hasManyThrough('App\CV','App\CV_Language');
   }
}
