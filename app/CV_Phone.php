<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV_Phone extends Model
{
    protected $fillable = [
      'cv_id','number','country_code',
    ];

    protected $table = 'cv_phones';

    public function getPhoneAttribute()
    {
      return $this->country_code.$this->number;
    }
    public function cv()
    {
      return $this->belongsTo('App\CV');
    }
}
