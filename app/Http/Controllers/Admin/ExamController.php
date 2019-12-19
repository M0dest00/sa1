<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\Question;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.exams.all', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'user')->whereDoesntHave('questions')->pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('admin.exams.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
          [
        'questions' => 'required|numeric|min:1',
        'pass_limit' => 'required|numeric|min:0',
        'user_id' => 'required|exists:users,id',
        'category_id' => 'required|exists:categories,id',
      ]
    );
        $num_of_questions = $request->questions;
        $category = Category::find($request->category_id);
        $user = User::find($request->user_id);

        // if ($num_of_questions) {
        //   $num_of_questions = min($num_of_questions, count($category->questions));
        //   $questions = $category->questions->random($num_of_questions);
        // } else {
        //   $num_of_questions = min(10, count($category->questions));
        //     $questions = $category->questions->random($num_of_questions);
        // }
        $num = count($category->questions);
        if ($num_of_questions > $num) {
            return redirect()->back()->with('error', 'Number of questions in Category : '.$category->name.' can not be greater than : '.$num.' . You may add more questions to this category.');
        }
        if ($request->pass_limit > $num_of_questions) {
            return redirect()->back()->with('error', 'Result to Pass must not be greater than total number of questions');
        }
        $questions = $category->questions->random($num_of_questions);
        foreach ($questions as $key => $value) {
            $user->questions()->attach($value);
        }
        $user['pass_limit'] = $request->pass_limit;
        $user->save();
        return redirect()->route('exam.index')->with('message', 'Exam Created Succefully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::find($id);
      $questions = $user->questions;
      return view('admin.exams.view',compact('user','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('role', 'user')->pluck('name', 'id');
        $user = User::find($id);
        $categories = Category::pluck('name', 'id');
        $category = $user->questions[0]->category;
        return view('admin.exams.edit', compact('user', 'users', 'categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->questions()->detach();
        $user->answers()->detach();
        $user['pass_limit'] = 0;
        $user['result'] = 0;
        $user['exam'] = 0;
        $user->save();
        return redirect()->route('exam.index')->with('message', 'Now user does not have an exam !! ');
    }
}
