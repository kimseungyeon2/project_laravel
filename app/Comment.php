<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'user_id',
    'content_id',
    'content_comment',
    'parent',
    'depth'
  ];
//public $timestamps = false;
  public function user(){
    return $this->belongsTo(User::class);
  }
  public function content(){
    return $this->belongsTo(Content::class);
  }

}
