<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\content;
use App\content_vote;
use App\hist;
use App\Comment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $page = $request->page;
      $contents = Content::paginate(1);
      return view('layouts.main_content_page')->with([
        'contents'=>$contents,
        'page'=>$page,
        'search_check'=>false//내 글 폼인지 아닌지 체크
      ]);
    }//main index 전체글보기
    public function my_index(Request $request){
      $page = $request->page;
      $contents = content::where('user_id',Auth::id())->paginate(5);
      return view('layouts.main_content_page')->with([
        'contents'=>$contents,
        'page'=>$page,
        'search_check'=>true//내 글 폼인지 아닌지 체크
      ]);
    }//my index 내글보기
    public function detail_index($id,Request $request){
      $page =$request->page;
      $content_vote = Content::find($id)->content_votes()->get();//해당 게시판 content_vote 가져오기
      $content = Content::find($id);//해당 게시판 content 가져오기
      $comments = Comment::where('content_id',$id)->with('user')->get();
      //Hists update
      if(Auth::check()){ //로그인 한 사용자만 조회수를 올릴수 있음
        $check_user = Hist::where('content_id',$id)->where('user_id',Auth::id())->first();
        if($check_user){
        }else{
          Hist::create([
            'content_id'=>$id,
            'user_id'=>Auth::id(),
          ]);
          Content::where('id',$id)->update(['content_hists'=>$content->content_hists+1]);//사용자 중복 방지 증가
        }
      }else{
        Content::where('id',$id)->update(['content_hists'=>$content->content_hists+1]);//미사용자 는 그냥 증가
      }
      //next view
      if(Auth::id() == $content->user_id){
          return view('layouts.detail')->with([
            'content'=>$content,
            'content_vote'=>$content_vote,
            'comments'=>$comments,
            'page'=>$page,
          ]);
      }else{
          return view('layouts.detail')->with([
            'content'=>$content,
            'content_vote'=>$content_vote,
            'comments'=>$comments,
            'page'=>$page,
          ]);
      }
    }//detail index 상세보기
    public function search(Request $request){
      $search = $request->search;
      $my_page = $request->my_page;
      $page = $request->page;
      //search
      if($my_page){
        //my page seach
        $result = Content::where('user_id',$my_page)
        ->where(function($q) use ($search){
            $q->where('content_title','LIKE',"%$search%")
              ->orWhere('content','LIKE',"%$search%");
        })->paginate(1);
        return view('layouts.main_content_page')->with([
          'contents'=>$result,
          'page'=>$page,
          'search_check'=>true,//내 글 폼인지 아닌지 체크
        ]);
      }else{
        //page seach
        $result = Content::where('content_title','LIKE',"%$search%")->orwhere('content','LIKE',"%$search%")->paginate(1);
        return view('layouts.main_content_page')->with([
          'contents'=>$result,
          'page'=>$page,
          'search_check'=>false//내 글 폼인지 아닌지 체크
        ]);
      }
    }//검색 페이지
    public function myStatus(){
      $myContents = content::where('user_id',Auth::id())->get();
      return view('layouts.myStatus')->with('myContents',$myContents);
    }//total content chart status
    public function myLogStatus(){
      $my_user = User::where('id',Auth::id())->first();
      return view('layouts.myLogStatus')->with('my_user',$my_user);
    }//my log status
}
