<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV_WorkHistory extends Model
{
    //
    protected $fillable = [
      'cv_id','job_title','description','company_name','from','to',
    ];

    protected $table = 'work_histories';
    
    public function cv()
    {
      return $this->belongsTo('App\CV');
    }
}
