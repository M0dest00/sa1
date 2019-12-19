<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;


class AdminController extends Controller
{


    public function getLogin(){

      if (Auth::check()) {
        return redirect()->route('admin.dashboard');
      }
      return view('admin.login');
    }


    public function postLogin(Request $request){
      if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('admin.dashboard');
        }
        else{
          return back()->withErrors(['Wrong Credentials']);
        }
    }


    public function getlogout(){
      Auth::logout();
      return view('admin.login');
    }



    public function getDashboard(){
      return view('admin.dashboard');
  }




}
