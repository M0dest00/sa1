<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Country;
use App\Question;
use App\UserQuestions;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;


class UserController extends Controller
{

	public function index()
    {
      $users = User::where('role', 'user')->get();
      return view('admin.users.all', compact('users'));
    }


    public function create()
    {
        $countries = Country::pluck('name','id');
        return view('admin.users.create', compact('countries'));
    }


    public function store(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'start' => $request->start,
            'end' => $request->end,
						'api_token' => Str::random(30),

        ]);
        return redirect()->route('user.index')->with('message','User Created Succefully');
    }


    public function edit($id)
    {

        $user = User::find($id);
        $countries = Country::pluck('name','id');

        return view('admin.users.edit', compact('user', 'countries'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191|unique:users,email,'.$id,
            'password' => 'sometimes|nullable|min:6',
            'phone' => 'required',
            'address' => 'required',
						'start' => 'required|date|after_or_equal:today',
            'end' => 'required|date|after:start',
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => ($request->password) ? bcrypt($request->password) : $user->password ,
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->country_id,
						'start' => $request->start,
            'end' => $request->end,
        ]);

      return redirect()->route('user.index')->with('message','User Edited Succefully');
    }



    public function delete($id)
    {

      $user = User::find($id)->delete();
      return redirect()->route('user.index')->with( 'message','User Had Been Deleted');
    }


    public function assignQuestions($id)
    {

      $user = User::find($id);
      ($user->exam == 0) ? $user->update(['exam' => 1]) : $user->update(['exam' => 0]);

      $user_question = UserQuestions::where('user_id', $id)->get();
      if(!count($user_question)) {
       $questions = Question::inRandomOrder()->take(2)->get();
       foreach ($questions as $question) {
           UserQuestions::create([
            'user_id' => $id,
            'question_id' => $question->id
        ]);
       }
       }

      return redirect()->route('user.index')->with( 'message','Exam assign Succefully');
    }

}
