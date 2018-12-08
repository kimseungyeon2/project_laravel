<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content_vote extends Model
{
  protected $fillable = [
    'content_id',
    'vote_content',
  ];//create()메소드로 인스턴스를 생성할 때는 해당 모델에 $fillable 속성을 지정해주어야 함.
  //public $timestamps = false;
  public function content(){
    return $this->belongsTo(Content::class);
  }
  public function vote_users(){
    return $this->hasMany(Vote_user::class);
  }
}
