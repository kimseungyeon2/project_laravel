<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use App\User;

class AuthController extends Controller
{
  public function redirect()
  {
      return \Socialite::driver('google')->redirect();
  }

  public function callback()
    {
      $googleUser = Socialite::driver('google')->user();
      $existUser = User::where('email',$googleUser->email)->first();

      if($existUser) {
          Auth::loginUsingId($existUser->id);
      }
      else {
          $user = new User;
          $user->name = $googleUser->name;
          $user->email = $googleUser->email;
          $user->password = md5(rand(1,10000));
          $user->my_image = 'User.png';
          $user->addrs = "google";
          $user->save();
          Auth::loginUsingId($user->id);
      }
      return redirect()->to('/');
    }
}
