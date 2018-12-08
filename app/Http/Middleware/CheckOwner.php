<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\Content;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::id();
        $id = $request->route('content');
        $contents = Content::find($id);

        if(!$contents || $user != $contents->user_id){
          flash('권한 이 없습니다.!')->error();
          return back();
        }
        else{
            return $next($request);
        }
    }
}
