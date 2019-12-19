<?php

namespace App\Http\Controllers\Skill;
use App\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
  public function create()
  {
    return view('admin.skill.create');
  }

  public function store(Request $request)
  {
    $this->validate($request,[
      'skill' => 'required|unique:skills,name|max:255|alpha_dash|',
    ]);

    $skill = Skill::create([
      'name' => $request->skill,
    ]);
    return redirect()->back()->with(['message' => 'Skill '.$skill->name.' created successfuly']);
  }
}
