<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BandMemberController extends Controller
{
    public function store(Request $request) {
        $member = $request->only('name', 'member_id');

        //member exists in the system so we'll link them to the band
        //and ask them if they approve of being in the band
        if(is_int($member['member_id']) and empty($member['name'])) {
            //add to band_members table with status 0
            $success = session('band')->members()->create([
                'user_id' => $member['member_id'],
                'status' => 0,
            ]);
            //send request
        } else { //just a static name
            dd(session('band'));
            $success = session('band')->members()->create([
                'name' => $member['name'],
                'status' => 1
            ]);
        }

        response()->json(['saved' => $success]);
    }
}
