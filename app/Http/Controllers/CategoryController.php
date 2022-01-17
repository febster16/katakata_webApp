<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('accessright');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category'] = Category::all();
        $data['menu'] = 'category';
        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Category::class);
        $data['menu'] = 'category_create';
        return view('admin.categories.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'name'=> 'required',
            'description'=> 'required',
            'status'=> 'required'
        ]);

        if(request('image')){
            $inputs['image'] = request('image')->store('category');
        }

        Category::create($inputs);

        session()->flash('category-created-message', 'Category with name '. $inputs['name'] . 'was created');

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize('view', $post);
//        if(auth()->user()->can('view', $post)){
//
//
//        }
        $data['category'] = Category::where('id',$id)->first();
        $data['menu'] = 'category';
        return view('admin.categories.edit', $data);
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
        $inputs = request()->validate([
            'name'=> 'required',
            'description'=> 'required',
            'status'=> 'required'
        ]);

        $category = Category::where('id',$id)->first();
        if(request('image')){
            $inputs['image'] = request('image')->store('category');
            $category->image = $inputs['image'];
        }

        $category->name= $inputs['name'];
        $category->description = $inputs['description'];
        $category->status = $inputs['status'];
        $category->save();
        session()->flash('category-updated-message', 'Category with name '.$inputs['name'].' was updated ');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //$this->authorize('delete', $post);
        $category = Category::where('id',$id)->first();
        $category->delete();
        $request->session()->flash('message', 'Category was deleted');
        return back();
    }

    public function assign(Request $request)
    {
        $category = Category::findorFail($request['id']);
        $category['status'] = "active";
        $category->update($request->all());

        return $request['id'];
    }

    public function unassign(Request $request)
    {
        $category = Category::findorFail($request['id']);
        $category['status'] = "in-active";
        $category->update($request->all());

        return $request['id'];
    }
}
