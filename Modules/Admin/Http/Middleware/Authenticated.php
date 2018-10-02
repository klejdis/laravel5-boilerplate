<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentinel;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authorized = $request->route()->getAction('authorized');

        //CHECK IF IS LOGGED IN
        if ($authorized || Sentinel::check()) {
            return $next($request);
        }else{
            //IF NOT LOGGED IN REDIRECT TO LOGIN PAGE
            return redirect()->route('admin.auth.login');
        }
    }
}
