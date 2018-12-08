<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote_user extends Model
{
  protected $fillable = [
      'user_id',
      'content_vote_num',
      'content_id',
  ];
  public function user(){
    return $this->belongsTo(User::class);
  }
  public function content(){
    return $this->belongsTo(Content::class);
  }
  public function content_vote(){
    return $this->belongsTo(Content_vote::class);
  }
}
