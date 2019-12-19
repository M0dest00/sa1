<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::all();
      return view('admin.categories.all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'required',
          'picture' => 'image',
      ]);
      $arr = [
        'name' => $request['name'],
        'description' => $request['description'],
      ];
      // if ($request->hasFile('picture')) {
      //     $file = $request->file('picture');
      //     $filename = $file->getClientOriginalName();
      //     $extension = $file->getClientOriginalExtension();
      //     $picture = sha1($filename . time()) . '.' . $extension;
      //     $destinationPath = public_path() . '/categories//';
      //     $request->file('picture')->move($destinationPath, $picture);
      //     $arr['picture'] = $picture;
      // }
      // else {
      //   $arr['picture'] = "default.jpeg";
      // }

      Category::create($arr);
      return redirect()->route('category.index')->with('message','Category Created Succefully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $category = Category::find($id);
      return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $category = Category::find($id);
      return view('admin.categories.edit', compact('category'));
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
      $this->validate($request, [
          'name' => 'required|max:255',
          'description' => 'required',
          'picture' => 'image',
      ]);
      $category = Category::find($id);

      $arr = [
        'name' => $request['name'],
        'description' => $request['description'],
      ];
      // if ($request->hasFile('picture')) {
      //     $file = $request->file('picture');
      //     $filename = $file->getClientOriginalName();
      //     $extension = $file->getClientOriginalExtension();
      //     $picture = sha1($filename . time()) . '.' . $extension;
      //     $destinationPath = public_path() . '/categories//';
      //     $request->file('picture')->move($destinationPath, $picture);
      //     $arr['picture'] = $picture;
      // }
      $category->update($arr);

    return redirect()->route('category.index')->with('message','Category Edited Succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::find($id)->delete();
      return redirect()->route('category.index')->with( 'message','Category Had Been Deleted');
    }
}
