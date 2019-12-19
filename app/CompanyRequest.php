<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRequest extends Model
{
    protected $fillable = [
      'company_id','tag_id',
    ];
    public function user()
    {
      return $this->belongsTo('App\User','company_id');
    }
    public function tag()
    {
      return $this->belongsTo('App\Tag');
    }
}
