<?php

namespace App\Http\Controllers;

use App\Mail\Confirmation;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;
class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);

        $this->middleware('guest',[
            'only' => ['create']
      ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {   

        $this->authorize('destroy',$user);

        $users = User::paginate(10);

        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Mail::to($user->email)->send(new Confirmation($user));

        session()->flash('success', 'A verification link has been sent to your email account.');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   

        $posts = $user->posts()
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);

        return view('users.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
      $this->authorize('update', $user);
      return view('users.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        session()->flash('success', 'User info successfully updated.');
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){

        $this->authorize('destroy', $user);

        $user->delete();

        session()->flash('success', 'The user has been deleted.');

        return back();
    }

    public function confirmEmail($token){
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null; 
        $user->save();

        Auth::login($user);
        session()->flash('success', 'Activation success!');
        return redirect()->route('users.show', [$user]);
    }

    public function followings(User $user){
        
        $users = $user->followings()->paginate(15);

        $title = $user->name . "'s Followings";

        return view('users.show_follow', compact('users','title','user'));
    }

    public function followers(User $user){
        
        $users = $user->followers()->paginate(15);

        $title = $user->name . "'s Followers";

        return view('users.show_follow', compact('users','title', 'user'));
    }

    public function private_switch(Request $request, User $user){
        
        if($request->ajax()){

            $user->is_public = $request->isChecked;

            $user->save();

        }
    }
}
