<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Category;
use App\Question;
use App\Answer;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;

class UserController extends Controller
{
    public function Login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            $now = Carbon::now();
            if ($user->exam == 0) {
                if ($user->start > $now) {
                    return response()->json(['code' => 202, 'message' =>'Your exam time has not started yet']);
                }
                if ($user->end < $now) {
                    return response()->json(['code' => 202, 'message' =>'Your exam time has finished']);
                }
            }

            return response()->json(['code' => 200,  'message' => 'Successful Login' , 'api_token' => $user->api_token]);
        } else {
            return response()->json(['code' => 202, 'message' =>'Incorrect email and/or password']);
        }
    }

    public function GenerateExam(Request $request)
    {
        // $num_of_questions = $request->questions;
        // $category = Category::find($request->category_id);
        if(!$request->has('api_token'))
        {
          return response()->json(['code' => 202, 'message' =>'Un-authorized User']);
        }
        $user = User::where('api_token',$request->api_token)->first();
        // if ($category && $user) {
        if ($user) {

          if($user->has('questions') && count($user->questions) != 0)
          {
            $questions = $user->questions;
            $ques = [];
            foreach ($questions as $key => $value) {
                $ques [$key]['question'] = $value->name;
                $ques [$key]['answers'] = $value->answers->pluck('answer','id');
            }
            return response()->json(['code' => 200,  'questions' => $ques ]);
          }
          else
          {
            return response()->json(['code' => 202, 'message' =>'User has no exams !!! ']);

          }
            // if ($num_of_questions) {
            //     $questions = $category->questions->random(min($num_of_questions, count($category->questions)));
            // } else {
            //     $questions = $category->questions->random(min(10, count($category->questions)));
            // }
            // $ques = [];
            // foreach ($questions as $key => $value) {
            //     $user->questions()->attach($value);
            //     $ques [$key]['name'] = $value->name;
            //     $ques [$key]['answers'] = $value->answers->pluck('answer');
            // }
            // return response()->json(['code' => 200,  'questions' => $ques ]);
        }
        return response()->json(['code' => 202, 'message' =>'Un-authorized User']);
    }

    public function Result(Request $request)
    {
      $result = 0;
      $answers = $request->answers;
      if(!$request->has('api_token'))
      {
        return response()->json(['code' => 202, 'message' =>'Un-authorized User']);
      }
      $user = User::where('api_token',$request->api_token)->first();
      if ($user && count($user->questions) != 0) {
        $questions = $user->questions->pluck('id');

        if ($user->exam == 0) {

          if($answers)
          {
            foreach ($answers as $key => $value) {
              $answer = Answer::where('id',$value)->whereIn('question_id',$questions)->first();
              if($answer)
              {
                $user->answers()->attach($answer);
              }
            }
          }
          else
          {
            return response()->json(['code' => 202, 'message' =>'No answers !!! ']);
          }

        }
        else {
          $result = $user->result;
          return response()->json(['code' => 200,  'message' => 'User took the exam earlier','result' => $result ]);
        }

      $result = count($user->answers->where('correct',1)->whereIn('question_id',$questions)->groupBy('question_id'));

      $user['result'] = $result;
      // Mark user as examed ?!!
      $user['exam'] = 1;
      $user->save();

      return response()->json(['code' => 200, 'message' => 'User finished the exam ' ,'result' => $result ]);
    }
    else {
      return response()->json(['code' => 202, 'message' =>'Un-authorized User']);

    }

    }
    public function createCv(Request $request)
    {
      // return $request;
      if($request->has('account_types')){
        $this->validate($request,[
          'account_types' => 'min:1',
          'social_accounts' => 'required|min:1',
        ]);
      }
      $this->validate($request,[
        'first_name' => 'required|max:255|alpha',
        'last_name' => 'required|max:255|alpha',
        'nationality' => 'required',
        'gender' => 'required',
        'birth_date' => 'required',
        'city' => 'required',
        'address' => 'required',
        'phone_numbers' => 'required|min:1',
        'country_codes' => 'required|min:1',
      ]);
      $city = City::find($request->city);
      $request_array = [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'date_of_birth' => $request->birth_date,
        'nationality' => $request->nationality,
        'gender_id' => $request->gender,
        'address' => $request->address,
        'city_id' => $request->city,
        'country_id' => $city->country_id,
      ];
      $fullImage = $request->file('picture');
      $fullImageName = $fullImage->getClientOriginalName() . time() . '.' . $fullImage->getClientOriginalExtension();
      $destinationPath = public_path() . '/cv/pictures//';
      $request->file('picture')->move($destinationPath, $fullImageName);
      $request_array['picture'] = $fullImageName;
      $request_array['driving_license_availablity'] = (isset($request->driving_license_availablity))? 1 : 0 ;
      $request_array['smoker'] = (isset($request->smoker))? 1 : 0 ;
      $request_array['travel_availablity'] = (isset($request->travel_availablity))? 1 : 0 ;
      // return $request_array;
      $cv = CV::create($request_array);
      $cvPhones = [];
      for ($i=0; $i < sizeof($request->phone_numbers); $i++) {
        $phoneNum = $request->country_codes[$i].$request->phone_numbers[$i];
        array_push($cvPhones,[
          'cv_id' => $cv->id,
          'phone' => $phoneNum,
        ]);
        CV_Phone::create($cvPhones[$i]);
      }
      $cvSocialAccounts = [];
      if($request->has('account_types')){
        for ($i=0; $i < sizeof($request->account_types); $i++) {
          array_push($cvSocialAccounts,[
            'cv_id' => $cv->id,
            'account' => $request->social_accounts[$i],
            'social_account_type' => $request->account_types[$i],
          ]);
          CV_SocialAccount::create($cvSocialAccounts[$i]);
        }
      }
    }
}
