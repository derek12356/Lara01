<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function __construct(){

      $this->middleware('guest',[
        'only' => ['create']
      ]);
    }

    public function create(){
    	return view('sessions.create');
    }

    public function store(Request $request){

 		$credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       ]);

 		if (Auth::attempt($credentials, $request->has('remember'))) {
        if(Auth::user()->activated){
             session()->flash('success','Welcome back!');
             $fallback = route('users.show', Auth::user());
             return redirect()->intended($fallback);
        }else{
          Auth::logout();
          session()->flash('warning', 'Your account have not been activated, please check email for activation.');
          return redirect('/');
        }

    } else {
           session()->flash('danger','Sorry, these credentials do not match our records.');
           return redirect()->back()->withInput();
       }
    }

    public function destroy(){
       
       Auth::logout();
       session()->flash('success', 'You have successfully logged out.');
       return redirect('login');
    }
}
