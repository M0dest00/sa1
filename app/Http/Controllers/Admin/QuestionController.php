<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\Category;
use App\Answer;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('admin.questions.all', compact('questions'));
    }


    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.questions.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'category_id' => 'required|exists:categories,id',
          'time' => 'required|numeric|min:1|max:120',
      ]);
        $arr = [
                'name' => $request['name'],
                'category_id' => $request['category_id'],
                'time' => $request['time'],
            ];

        $wrong = $request['answers'];
        $correct = $request['correct_ans'];
        if( count(array_intersect($wrong,$correct)))
        {
          return redirect()->back()->with('error','An answer cannot be correct and right in the same time !!');
        }
        $question = Question::create($arr);
        if (isset($request['correct_ans']) && is_array($request['correct_ans'])) {
            $correct_ans = $request['correct_ans'];
            foreach ($correct_ans as $answer) {
                $question->answers()->create(['answer' => $answer,
                    'correct' => '1',
                ]);
            }
        }
        if (isset($request['answers']) && is_array($request['answers'])) {
            $answers = $request['answers'];
            foreach ($answers as $answer) {
                $question->answers()->create(['answer' => $answer,
                    'correct' => '0',
                ]);
            }
        }
        return redirect()->route('question.index')->with('message', 'Question Created Succefully');
    }


    public function edit($id)
    {
        $question = Question::find($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.questions.edit', compact('question', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'name' => 'required',
          'category_id' => 'required|exists:categories,id',
          'time' => 'required|numeric|min:1|max:120',


      ]);
        $arr = [
                'name' => $request['name'],
                'category_id' => $request['category_id'],
                'time' => $request['time'],

            ];

            $wrong = $request['answers'];
            $correct = $request['correct_ans'];
            if( count(array_intersect($wrong,$correct)))
            {
              return redirect()->back()->with('error','An answer cannot be correct and right in the same time !!');
            }
        $question = Question::find($id);

        if (isset($request['correct_ans']) && is_array($request['correct_ans'])) {
          $question->answers()->where('correct','1')->whereNotIn('answer',$request['correct_ans'])->delete();
            $correct_ans = $request['correct_ans'];
            foreach ($correct_ans as $answer) {
                $existed = $question->answers->where('answer', $answer)->where('correct','1');
								if(count($existed) == 0)
                {
                    $question->answers()->create([
											'answer' => $answer,
											'correct' => '1',
                ]);
							}
            }
        }
        if (isset($request['answers']) && is_array($request['answers'])) {
          $question->answers()->where('correct','0')->whereNotIn('answer',$request['answers'])->delete();
            $answers = $request['answers'];
            foreach ($answers as $answer) {
							$existed = $question->answers->where('answer', $answer)->where('correct','0');
							if (count($existed) == 0) {
								$question->answers()->create(['answer' => $answer,
                    'correct' => '0',
                ]);
							}

            }
        }
        $question->update($arr);

        return redirect()->route('question.index')->with('message', 'Question Edited Succefully');
    }



    public function delete($id)
    {
        $question = Question::find($id);
        if($question)
        {
          $question->answers()->delete();
          $question->delete();
          return redirect()->route('question.index')->with('message', 'Question Had Been Deleted');
        }
        return redirect()->route('question.index')->with('message', 'No Question To Be Deleted !!');

    }
}
