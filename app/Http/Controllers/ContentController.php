<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\content;
use App\content_vote;
use App\hist;

class ContentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function __construct(){
       $this->middleware('auth');
       $this->middleware('owner')->only(['update','destroy']);
  }
  public function index(Request $request){

  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
    return view('layouts.insert');
  }//insert_form

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
    $this->validate($request,[
          'content_title'=>'required',
          'content_img'=>'required',
          'content_kinds'=>'required',
          'content_url'=>'required',
          'content'=>'required',
        ]);
    //content_image 저장
    $file_name = $request->file('content_img')->getClientOriginalName();
    $request->content_img->storeAs('public',$file_name);
    //content 저장
    Content::create([
      'content_title'=>$request->content_title,
      'user_id'=>Auth::id(),
      'content_image'=>$file_name,
      'content'=>$request->content,
      'content_url'=>$request->content_url
    ]);
    //content_vote 저장
    for ($i=0; $i <count($request->content_kinds); $i++){
        $content = Content::where('content_title',$request->content_title)->first();
        content_vote::create([
          'content_id'=>$content->id,
          'vote_content'=>$request->content_kinds[$i]
        ]);
    }
    return back()->with('success',true);
  }//insert

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id){
    $content_view = Content::where('id',$id)->first();
    $content_vote_view = Content_vote::where('content_id',$id)->get();
    return view('layouts.update')->with([
      'content_view'=>$content_view,
      'content_vote_view'=>$content_vote_view
    ]);
  }//update_form

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id){
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
    $this->validate($request,[
          'content_title'=>'required',
          'content'=>'required',
          'content_kinds'=>'required',
          'content_url'=>'required',
        ]);
    //content_img 저장
    $file_name = $request->file('content_img')->getClientOriginalName();
    $request->content_img->storeAs('public',$file_name);
    //content insert
    $content = Content::where('id',$id)->update([
      'content_title'=>$request->content_title,
      'user_id'=>Auth::id(),
      'content_image'=>$file_name,
      'content'=>$request->content,
      'content_url'=>$request->content_url
    ]);
    //update content_vote
    $content_votes = Content::find($id)->content_votes()->get();//해당 게시글 원본 content_vote 가져오기
    $kinds_check_num = 0;//수정 컬럼
    for ($i=0; $i <count($content_votes); $i++) {
      $kinds_check_num++;
      $content_votes[$i]->update([
        'vote_content'=>$request->content_kinds[$i]
      ]);
    };
    //insert content_vote
    for ($i=$kinds_check_num; $i <count($request->content_kinds); $i++) {
      $content = Content::where('content_title',$request->content_title)->first();
      content_vote::create([
        'content_id'=>$content->id,
        'vote_content'=>$request->content_kinds[$i]
      ]);
    };
    return back();
  }//update

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id){
    $content = Content::where('id',$id);
    $content->delete();
    return redirect("my_index/".Auth::id());
  }//delete
}
