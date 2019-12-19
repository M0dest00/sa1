<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccountType extends Model
{
  protected $fillable = ['name'];

  public function social_accounts()
  {
    return $this->hasMany('App\CV_SocialAccount');
  }
}
