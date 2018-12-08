<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      return view('componet.comment_view.comment_insert_form')->with('content_id',$request->id);
    }// comment insert form

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $content_id = $request->content_id;
      $comment_content = $request->content;
      Comment::create([
         'user_id'=>Auth::id(),
         'content_id'=>$content_id,
         'content_comment'=>$comment_content
       ]);
       $comments = Comment::where('content_id',$content_id)->with('user')->get();
       $content = Content::where('id',$content_id)->first();
       return view('componet.comment_view.comment')->with([
         'comments'=>$comments,
         'content'=>$content
       ]);
    }//comment insert

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
       return view('componet.comment_view.comment_update_form')->with([
         'comment_id'=>$id,
         'content_comment'=>$request->content,
         'content_id'=>$request->id
      ]);
    }//comment update form

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
       Comment::find($id)->update([
         'content_comment'=>$request->content
       ]);
       $comments = Comment::where('content_id',$request->content_id)->with('user')->get();
       $content = Content::where('id',$request->content_id)->first();
       return view('componet.comment_view.comment')->with([
         'comments'=>$comments,
         'content'=>$content
       ]);
    }//comment update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
      Comment::find($id)->delete();
      $comments = Comment::where('content_id',$request->content_id)->with('user')->get();
      $content = Content::where('id',$request->content_id)->first();
      return view('componet.comment_view.comment')->with([
        'comments'=>$comments,
        'content'=>$content
      ]);
    }//comment delete
}
