<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = ['name', 'email', 'password', 'picture', 'api_token', 'exam', 'interview','role','phone','address','country_id','start','end','result','pass_limit'];

    protected $hidden = [
        'password', 'remember_token',
    ];



    public function UserQuestions()
    {
        return $this->hasMany('App\UserQuestions');
    }

    public function questions()
    {
      return $this->belongsToMany('App\Question','user_questions');
    }

    public function answers()
    {
      return $this->belongsToMany('App\Answer','answer_users');
    }
}
