<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->only('create');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      //Register datas
      $file_name = $data['my_image']->getClientOriginalName();
      $data['my_image']->storeAs('public',$file_name);//image
      $addrs = $data['addrs0'].'-'.$data['addrs1'].'-'.$data['addrs2'];//addrs
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'my_image' => $file_name,
        'addrs' => $addrs
      ]);
    }
    //register password check
    public function check_log(Request $request){
      if(password_verify($request->password, Auth::User()->password)){
        if($request->log_kind == 'update'){
          $user = User::where('id',Auth::id())->first();
          $addrs = explode("-",$user->addrs);
          return view('layouts.register_update')->with([
            'user'=>$user,
            'addrs'=>$addrs,
            'password'=>$request->password,
          ]);
        }
        else if($request->log_kind == 'delete'){
          return view('layouts.register_delete');
        }
        else{
          back();
        }
      }else{
        return back();
      }
    }
    //register update
    public function update(Request $request, $id){
      //Register datas
      $file_name = $request->file('my_image')->getClientOriginalName();
      $request->file('my_image')->storeAs('public',$file_name);//image

      $addrs = $request->addrs0.'-'.$request->addrs1.'-'.$request->addrs2;//addrs
      User::where('id',$id)->update([
        'name' => $request->name,
        'email' => Auth::user()->email,
        'password' => Hash::make($request->password),
        'my_image' => $file_name,
        'addrs' => $addrs
      ]);
      return redirect('myLogStatus');
    }
    //register delete
    public function destroy($id){
      User::where('id',$id)->delete();
      return redirect('/');
    }//delete
}
