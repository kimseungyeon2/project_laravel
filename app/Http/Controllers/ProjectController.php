<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\content_vote;
use App\Vote_user;

use Mail;
use Event;
use App\Events\MailSend;

class ProjectController extends Controller
{
   public function __construct(){

   }
   public function ck_fileUpload(Request $request){
     if($request->file('upload')){
       $file_name = $request->file('upload')->getClientOriginalName();
       $path = $request->upload->storeAs('public',$file_name);
       $url =asset('storage/'.$file_name);
       echo '{"filename" : "'.$file_name.'", "uploaded" : 1, "url":"'.$url.'"}';
     }else{
       return back()->with('error',true);
     }
   }//ckeditor upload

   public function chart($content_num,$vote_num){
     $vote_user = Vote_user::where('user_id',Auth::id())->where('content_id',$content_num)->first();
     if($vote_user){
       return "이미 투표 하셨습니다.";
     }else{
       Vote_user::create([
         'user_id'=>Auth::id(),
         'content_vote_num'=>$vote_num,
         'content_id'=>$content_num
       ]);
       $content_vote = Content_vote::where('id',$vote_num)->first();
       $vote_point_update = $content_vote->vote_point +1;
       Content_vote::where('id',$vote_num)->update(['vote_point'=>$vote_point_update]);
       return Auth::user()->name."님 투표하셨습니다.";
     }
   }//chart data update from ajax

   public function server($data){
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    //retry: 1000;
    $content_vote = Content_vote::where('content_id',$data)->get();
    // $content_vote = $content_vote->toArray();

    for ($i=0; $i <count($content_vote); $i++) {
      $content_vote_arr[$i] = array(
        "y"=> $content_vote[$i]['vote_point'],
        "name"=> $content_vote[$i]['vote_content']
      );
    }
    $server_data = json_encode($content_vote_arr);
    echo "data:{$server_data}\n\n";
    echo "event: ping\n";
    flush();
  }//chart_html server sent event(SSE) the server

}
