<?php

namespace App\Http\Controllers\Certificate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Certificate;
class CertificateController extends Controller
{
    public function create()
    {
      return view('admin.certificate.create');
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'certificate' => 'required|max:255|unique:certificates,certificate|',
      ]);
      Certificate::create([
        'certificate' => $request->certificate,
      ]);
      return redirect()->back()->with(['message' => $request->certificate.' certificate created successfuly']);
    }
}
