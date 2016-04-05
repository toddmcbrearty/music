<?php

namespace App\Http\Middleware;

use Closure;

class ApplicationSetup
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
        //setting the APPLICATION session lets us know what
        //part of the site we are using
        if(is_null($request->segment(1))) {
            session('APPLICATION', 'index');
        } else if(in_array($request->segment(1), ['band', 'fan'])) {
            session('APPLICATION', $request->segment(1));
        }

        return $next($request);
    }
}
