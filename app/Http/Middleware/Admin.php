<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()){
            $user = auth()->user();
            if($user->role_id == 1){
                return $next($request);
            }
        }
        return redirect('/');
    }

}
