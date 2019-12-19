<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
      'certificate','description',
    ];

    protected $table = 'certificates';
    
    public function cv()
    {
      return $this->hasManyThrough('App\CV','App\CV_Certificate');
    }
}
