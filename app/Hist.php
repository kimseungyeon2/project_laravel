<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hist extends Model
{
  protected $fillable = [
    'content_id',
    'user_id',
  ];
  public function user(){
    return $this->belongsTo(User::class);
  }
  public function content(){
    return $this->belongsTo(Content::class);
  }
}
