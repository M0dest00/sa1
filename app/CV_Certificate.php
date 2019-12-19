<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV_Certificate extends Model
{
    //
    protected $fillable = [
      'cv_id','certificate_id','description',
    ];
    protected $table = 'cv_certificates';

}
