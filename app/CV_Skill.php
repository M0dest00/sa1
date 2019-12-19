<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV_Skill extends Model
{
    //
    protected $fillable = [
      'cv_id','skill_id','description',
    ];
    protected $table = 'cv_skills';
    public function skill()
    {
      return $this->belongsTo('App\Skill');
    }
    public function CV()
    {
      return $this->belongsTo('App\CV');
    }
}
