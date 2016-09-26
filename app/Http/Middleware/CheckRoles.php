<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
      //return var_dump($roles);
        if(Auth::User()){
        $user_roles = $request->user()->roles()->getResults();

        $is_allowed = 0;
        foreach($user_roles as $ur){

          foreach($roles as $role){

            if ($ur->type == $role) {
              $is_allowed = 1;
            }
          }
        }

        if(!$is_allowed){
          return redirect('/login');
        }

        return $next($request);
      }
      else{
        return redirect('/login');
      }
    }
}
