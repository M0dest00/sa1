<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    protected $fillable = [
      'first_name','last_name','date_of_birth','nationality','gender_id','address','city_id','country_id','picture',
      'driving_license_availablity','smoker','travel_availablity','cv_pdf','user_id',
    ];

    protected $table = 'cv';

    public function getAgeAttribute()
    {
      return Carbon::parse($this->date_of_birth)->age;
    }
    public function getFullNameAttribute()
    {
      return ucfirst($this->first_name)." ".ucfirst($this->last_name);
    }
    public function picture_path()
    {
      return 'cv/pictures/'.$this->picture;
    }
    public function phones()
    {
      return $this->hasMany('App\CV_Phone');
    }
    public function certificates()
    {
      return $this->hasManyThrough('App\Certificate','App\CV_Certificate');
    }
    public function social_accounts()
    {
      return $this->hasMany('App\CV_SocialAccount');
    }
    public function language()
    {
      return $this->hasManyThrough('App\Language','App\CV_Language');
    }
    public function work_histories()
    {
      return $this->hasMany('App\CV_WorkHistory');
    }
    public function education_histories()
    {
      return $this->hasMany('App\CV_EducationHistory');
    }
    public function skills()
    {
      return $this->hasManyThrough('App\Skill','App\CV_Skill');
    }
    public function tags()
    {
      return $this->hasManyThrough('App\Tag','App\CV_Tag','cv_id','id');
    }
    public function cv_tags()
    {
      return $this->hasMany('App\CV_Tag', 'cv_id');
    }
    public function gender()
    {
      return $this->belongsTo('App\Gender');
    }
    public function country()
    {
      return $this->belongsTo('App\Country');
    }
    public function city()
    {
      return $this->belongsTo('App\City');
    }
}
