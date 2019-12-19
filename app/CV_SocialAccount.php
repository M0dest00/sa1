<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV_SocialAccount extends Model
{
    //
    protected $fillable = [
      'cv_id','account','social_account_type',
    ];

    protected $table = 'social_accounts';

    public function cv()
    {
      return $this->belongsTo('App\CV');
    }
    public function account_type()
    {
      return $this->belongsTo('App\SocialAccountType');
    }
}
