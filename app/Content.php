<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
      'user_id',
      'content_title',
      'content_image',
      'content',
      'content_url'
    ];//create()메소드로 인스턴스를 생성할 때는 해당 모델에 $fillable 속성을 지정해주어야 함.
    public function user(){
      return $this->belongsTo(User::class);
    }
    public function content_votes(){
      return $this->hasMany(Content_vote::class);
    }
    public function hists(){
      return $this->hasMany(Hist::class);
    }
    public function comments(){
      return $this->hasMany(Comment::class);
    }
    public function vote_users(){
      return $this->hasMany(Vote_user::class);
    }
}
