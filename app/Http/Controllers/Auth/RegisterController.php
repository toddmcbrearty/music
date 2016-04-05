<?php

namespace App\Http\Controllers\Auth;

use App\Band;
use App\Http\Requests\Auth\StoreUserRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo   = '/';
    protected $registerView = 'band.register';
    private   $_user;
    private   $band;
    private   $_validationConfig;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->_user             = new User;
        $this->band              = new Band;
        $this->_validationConfig = config('validation.registration');
    }

    protected function validator(array $data, array $validation)
    {
        return Validator::make($data, $validation);
    }

    protected function registerUser(Request $request)
    {
        $validations = $this->_validationConfig['user'];
        $bandName = null;
        if($request->has('band_name')) {
            $validations = $validations+ $this->_validationConfig['band'];
            $bandName = $request->band_name;
        }

        $validator = $this->validator($request->all(), $validations);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = $this->createUser(
            $request->identifier,
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->password,
            $request->has('band_name'), //tells createUser to create a band
            $bandName
        );

        return response()->json($user);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param string $identifier
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param bool $createBand
     * @param string $bandName
     *
     * @return User
     */
    protected function createUser(string $identifier, string $firstName, string $lastName, string $email, string $password, bool $createBand = false, string $bandName = null)
    {

        $this->_user = $this->_user->make(
            $identifier,
            $firstName,
            $lastName,
            $email,
            $password
        );

        if ($createBand) {
            $band = $this->createBand($bandName);
            $this->_user->bands()->attach($band);
        }

        return $this->_user;
    }


    public function createBand($bandName)
    {
        $this->band = $this->band->make($bandName);

        //create the bands filesystem storage
        Storage::disk('media')->makeDirectory($this->band->id.'/audio/cache');
        return $this->band;
    }
}
