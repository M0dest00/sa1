<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQuestions extends Model
{
    protected $fillable = ['user_id', 'question_id'];    
}
