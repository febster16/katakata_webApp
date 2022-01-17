<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('accessright');
    }

    public function index(){

        $auth_id = Auth::user()->getAuthIdentifier();
        $users = User::where('id','!=',$auth_id)->get();
        return view('admin.users.index', ['users'=>$users]);
    }

    public function show(User $user){
        return view('admin.users.profile', ['user'=>$user]);
    }

    public function create(){
       // return "a";
        //$this->authorize('create', User::class);
        return view('admin.users.create');
    }

    public function store(){

        //$this->authorize('create', User::class);

        $inputs = request()->validate([
            'username'=> 'required',
            'name'=> 'required',
            'avatar'=> 'file',
            'email'=> 'required',
            'password'=> 'required'
        ]);


//        if(request('post_image')){
//            $inputs['post_image'] = request('post_image')->store('images');
//        }

        $user = User::create($inputs);
//        auth()->user()->users()->create($inputs);

        session()->flash('user-created-message', 'User name '. $inputs['username'] . 'was created');

        return redirect()->route('user.index');

    }

    public function edit($id){

        //$this->authorize('view', $user);
        $user = User::where('id',$id)->first();
        return view('admin.users.edit', ['user'=> $user]);
    }

    public function update(Request $request,$id){

        $inputs = request()->validate([
            'username'=> ['required', 'string', 'max:255','alpha_dash'],
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255'],
            'avatar'=> ['file']
        ]);

        $user = User::findorFail($id);

        if (!empty($request['password'])) {
        } else {
            unset($request['password']);
        }

        $inputs = $request->all();

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);
        session()->flash('user-updated', 'User has been updated');
        return redirect('admin/users');
    }

    public function destroy(User $user){
        $user->delete();
        session()->flash('user-deleted', 'User has been deleted');
        return back();
    }
}
