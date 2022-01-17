<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('accessright');
    }

    public function index(){
        $posts = Post::all();
        foreach ($posts as $post){
            $post['category_name'] = '';
            $category_name = Category::where('id',$post['category_id'])->first();
            if($category_name){
                $post['category_name'] = $category_name['name'];
            }
        }
        return view('admin.posts.index', ['posts'=> $posts]);
    }

    public function show(Post $post){
        return view('blog-post', ['post'=> $post]);
    }

    public function create(){
        //$this->authorize('create', Post::class);
        $data['category'] = Category::where('status','active')->get();
        return view('admin.posts.create',$data);
    }

    public function store(){

        //$this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required',
            'status' => 'required',
            'category_id' => 'required',
        ]);


        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
        auth()->user()->posts()->create($inputs);

        session()->flash('post-created-message', 'Post with title '. $inputs['title'] . 'was created');

        return redirect()->route('post.index');

    }

    public function edit(Post $post){

        //$this->authorize('view', $post);
//        if(auth()->user()->can('view', $post)){
//
//
//        }
        $data['category'] = Category::where('status','active')->get();
        $data['post'] = $post;
        return view('admin.posts.edit', $data);
    }

    public function destroy(Post $post ,Request $request){

        //$this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('message', 'Post was deleted');
        return back();
    }

    public function update(Request $request,$id){

        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required',
            'status' => 'required',
            'category_id' => 'required',
        ]);

        $post = Post::where('id',$id)->first();

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->status = $inputs['status'];
        $post->category_id = $inputs['category_id'];
        $post->save();
        session()->flash('post-updated-message', 'Post with title '. $inputs['title']. ' was updated');
        return redirect()->route('post.index');
    }

    public function assign(Request $request)
    {
        $post = Post::findorFail($request['id']);
        $post['status'] = "active";
        $post->update($request->all());

        return $request['id'];
    }

    public function unassign(Request $request)
    {
        $post = Post::findorFail($request['id']);
        $post['status'] = "in-active";
        $post->update($request->all());

        return $request['id'];
    }
}
