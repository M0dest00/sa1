<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV_EducationHistory extends Model
{
    //
    protected $fillable = [
      'cv_id','from','to','education_institution','description',
    ];

    protected $table = 'education_histories';
    
    public function cv()
    {
      return $this->belongsTo('App\CV');
    }
}
