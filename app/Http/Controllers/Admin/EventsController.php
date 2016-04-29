<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventsController extends Controller
{
    public function index() {
        return view('admin.events.index');
    }
}
