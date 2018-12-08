<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'my_image',
        'addrs',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function contents(){
      return $this->hasMany(Content::class);
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
