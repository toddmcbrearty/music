<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Lcobucci\JWT\Builder;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username   = 'identifier';
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        //validate the user belongs to the band.
        $user = \Auth::user();
        $band = $user->bands->where('id', (int) $request->get('band'))->first();

        if ( ! $band) {
            return response()->json(['error' => 'You are not in the band']);
        }

        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        $siteurl = config('app.url');

        //we are successfully logged. we'll create the session token
        $jwt = (new Builder)->setIssuer($siteurl)
                            ->setAudience($siteurl)
                            ->setId(env('APP_KEY'), true)
                            ->setIssuedAt(time())
                            ->setExpiration(time() + 3600)
                            ->set('uid', Crypt::encrypt($user->id))
                            ->set('bid', Crypt::encrypt($band->id))
                            ->getToken();

        return $jwt;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json(['errors' => $this->getFailedLoginMessage()]);
    }

}
