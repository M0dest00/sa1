<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['name', 'correct_ans', 'ans_1', 'ans_2','category_id','time'];
    public function category()
    {
      return $this->belongsTo('App\Category');
    }
    public function answers()
    {
      return $this->hasMany('App\Answer');
    }
    public function correct_ans()
    {
      return $this->answers->where('correct','1');
    }
}
