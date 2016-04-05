<?php

namespace App\Http\Middleware;

use App\Band;
use App\User;
use Closure;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Crypt;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class ApiAuth
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
        $siteurl = config('app.url');
        $validation = new ValidationData(); // It will use the current time to validation (iat, nbf and exp)
        $validation->setIssuer($siteurl);
        $validation->setAudience($siteurl);
        $validation->setId(env('APP_KEY'));

        $authToken = $request->header('authorization');
        $token = (new Parser())->parse((string) $authToken);

        if( ! $token->validate($validation)) {
            throw new UnauthorizedException;
        }

        session(['user' => User::find(Crypt::decrypt($token->getClaim('uid')))]);
        session(['band' => Band::find(Crypt::decrypt($token->getClaim('bid')))]);

        return $next($request);
    }
}
