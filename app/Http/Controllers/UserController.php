<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function show($id) {
        $user = User::find($id);
        
        if(!$user) {
            abort(400, 'Invalid User');
        }

        dd($user, $user->profile(session('band')->id));
    }
}
