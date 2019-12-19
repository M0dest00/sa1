<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV_Language extends Model
{
    //
    protected $fillable = [
      'cv_id','language_id','description',
    ];
    protected $table = 'cv_languages';

    public function language()
    {
      return $this->belongsTo('App\Language');
    }
}
