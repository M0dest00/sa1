<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
  protected $fillable = [
    'cv_id','interviewer','supervisor','from','temp_username','temp_password','to','confirmation',
  ];
  protected $table = 'interviews';

  public function cv()
  {
    return $this->belongsTo('App\CV');
  }
}
