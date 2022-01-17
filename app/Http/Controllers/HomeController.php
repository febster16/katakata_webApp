<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index(Request $request,$id=null)
    {
        if (isset($request['keyword']) && $request['keyword']!=""){

            $query = Post::Where(function ($query)  use ($request){
                $query->orwhere('title', 'like', '%' . $request['keyword'] . '%')
                    ->orwhere('body', 'like','%' . $request['keyword'] . '%');
            })->where('status','active')->select();
        }
        else {

            $query = Post::where('status','active')->select();
        }
        if($id!=""){
            $posts = $query->where('category_id',$id)->orderBy('id','DESC')->paginate(10);
            $selected_cat = $id;
        }
        else{
            $selected_cat = 0;
            $posts = $query->orderBy('id','DESC')->orderBy('id','DESC')->paginate(10);
        }

        $link = $posts->withPath('/');
        //return $link;
        $category = Category::where('status','active')->orderBy('name','ASC')->get();

        return view('home', ['posts'=> $posts,'categories'=>$category,'links'=>$link,'selected_category'=>$selected_cat]);
    }

    public function search(Request $request,$id=null)
    {
        if (isset($request['keyword']) && $request['keyword']!=""){

            $query = Post::Where(function ($query)  use ($request){
                $query->orwhere('title', 'like', '%' . $request['keyword'] . '%')
                    ->orwhere('body', 'like','%' . $request['keyword'] . '%');
            })->where('status','active');
        }
        else {

            $query = Post::where('status','active');
        }
        if($id!=""){
            $posts = $query->where('category_id',$id)->orderBy('id','DESC')->paginate(10);
            $selected_cat = $id;
        }
        else{
            $selected_cat = 0;
            $posts = $query->orderBy('id','DESC')->paginate(10);
        }

        $link = $posts->withPath('/');
        //return $link;
        $category = Category::where('status','active')->get();

        return view('home', ['posts'=> $posts,'categories'=>$category,'links'=>$link,'selected_category'=>$selected_cat]);
    }

    public function post_detail($id)
    {
        $category = Category::where('status','active')->get();
        $posts = Post::where('id',$id)->first();
        $comments = Comment::where('post_id',$id)->where('parent_id',0)->where('status','approved')->get();
        return view('blog-post', ['post'=> $posts,'categories'=>$category,'comments'=>$comments]);
    }

    public function create_post(){
        $data['category'] = Category::where('status','active')->get();
        return view('create-post',$data);
    }

    public function store_post(Request $request){
        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required',
            'category_id' => 'required',
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
        $inputs['status'] = "in-active";
        auth()->user()->posts()->create($inputs);

        \Illuminate\Support\Facades\Session::flash('message', 'Post created successfully!');
        \Illuminate\Support\Facades\Session::flash('alert-class', 'alert-success');

        return redirect()->route('user.my_post');
    }

    public function my_post(){
        $user_id = Auth::user()->id;
        $data['posts'] = Post::where('user_id',$user_id)->get();
        return view('my-post',$data);
    }

    public function my_post_edit($id){
        $data['posts'] = Post::where('id',$id)->first();
        $data['category'] = Category::where('status','active')->get();
        return view('edit-post',$data);
    }

    public function my_post_update($id){
        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required',
            'category_id' => 'required',
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }

        $post = Post::where('id',$id)->first();
        $post->update($inputs);
        //auth()->user()->posts()->create($inputs);
        \Illuminate\Support\Facades\Session::flash('message', 'Post updated successfully!');
        \Illuminate\Support\Facades\Session::flash('alert-class', 'alert-success');

        return redirect()->route('user.my_post');
    }

    public function my_post_destroy($id){
        $post = Post::where('id',$id)->delete();
        \Illuminate\Support\Facades\Session::flash('message', 'Post deleted successfully!');
        \Illuminate\Support\Facades\Session::flash('alert-class', 'alert-danger');
        return redirect()->route('user.my_post');
    }

    public function profile(){
        $data['user'] = Auth::user();
        return view('profile',$data);
    }

    public function update_profile(Request $request){
        $inputs = request()->validate([
            'username'=> ['required', 'string', 'max:255','alpha_dash'],
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255'],
            'avatar'=> ['file']
        ]);

        $id = Auth::user()->id;
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
        \Illuminate\Support\Facades\Session::flash('message', 'Profile updated successfully!');
        \Illuminate\Support\Facades\Session::flash('alert-class', 'alert-success');
        return redirect('user/profile');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }

    public function add_comment(Request $request){
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['status'] = 'pending';
        $comment = Comment::create($input);
        \Illuminate\Support\Facades\Session::flash('message', 'comment added successfully!');
        \Illuminate\Support\Facades\Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}
