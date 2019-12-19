<?php

namespace App\Http\Controllers\Interview;
use App\CV;
use App\Interview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InterviewController extends Controller
{
  public function create($cv_id)
  {
    $cv = CV::find($cv_id);
    return view('admin.interview.create',compact('cv'));
  }
}
