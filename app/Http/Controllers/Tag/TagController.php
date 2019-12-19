<?php

namespace App\Http\Controllers\Tag;
use App\TagType;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function getTagType()
    {
      return view('admin.tag.tagType');
    }

    public function postTagType(Request $request)
    {
      $this->validate($request,[
        'tagType' => 'required|max:255|unique:tag_types,name|alpha_dash',
      ]);
      TagType::create([
        'name' => $request->tagType,
      ]);
      return redirect()->back()->with(['message' =>"Tag Type ".$request->tagType." has been created successfuly"]);
    }

    public function getTag()
    {
      $tagTypes = TagType::all();
      return view('admin.tag.tag',compact('tagTypes'));
    }

    public function postTag(Request $request)
    {
      $this->validate($request,[
        'tagType' => 'required',
        'tag' => 'required|max:255|unique:tags,name',
      ]);
      Tag::create([
        'name' => $request->tag,
        'tag_type_id' => $request->tagType,
      ]);
      return redirect()->back()->with(['message' => "Tag ".$request->tag." created successfuly"]);
    }
    public function viewTag()
    {
      return view('admin.tag.all');
    }
}
