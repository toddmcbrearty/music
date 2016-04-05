<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BandController extends Controller
{
    public function index() {
        return response()->json(session('band'));
    }

    public function update(Request $request, integer $id) {
        $data = $request->only('name', 'biography');
        session(['band' => session('band')->update($data)]);

        return $this->index();
    }
}
