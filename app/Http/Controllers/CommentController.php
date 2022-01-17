<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
    public function pending_comment()
    {
        $data['comments'] = Comment::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.comment.pending',$data);
    }

    public function approved_comment()
    {
        $data['comments'] = Comment::where('status','approved')->orderBy('id','DESC')->get();
        return view('admin.comment.approve',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
        $comment = Comment::where('id',$id)->first();
        $comment->delete();
        $request->session()->flash('message', 'Comment was deleted');
        return back();
    }

    public function status(Request $request,$status, $id){
        $comment = Comment::where('id',$id)->first();
        if($status == 'approve'){
            $comment->status = 'approved';
            $request->session()->flash('approved', 'Comment approved!');
        }
        if($status == 'reject'){
            $comment->status = 'rejected';
            $request->session()->flash('rejected', 'Comment rejected!');
        }

        $comment->save();
        return back();
    }
}
