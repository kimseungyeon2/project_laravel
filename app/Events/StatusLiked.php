<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class StatusLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $message;
    public $content;//게시글 확인

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username,$content)
    {
      $content_user = \App\Content::where('id',$content)->first()->user_id;
      if($content_user == \Illuminate\Support\Facades\Auth::id()){
        $this->username = $username;
        $this->content = $content;//게시글 확인
        $this->message = "지금막 {$username}님이 투표 하셨습니다.";
      }
      else{
        $this->username = $username;
        $this->content = $content;//게시글 확인
        $this->message = "-";
      }

      // if($content_user == Auth::id()){
      //   $this->username = $username;
      //   $this->content = $content;//게시글 확인
      //   $this->message = "지금막 {$username}님이 투표 하셨습니다.";
      // }else{
      //   $this->username = $username;
      //   $this->content = $content;
      //   $this->message = "-";
      // }
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['status-liked'];
        //return new PrivateChannel('channel-name');
    }
}
