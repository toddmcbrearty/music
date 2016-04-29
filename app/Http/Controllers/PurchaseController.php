<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PurchaseController extends Controller
{
    public function store(Request $request) {
        if( ! session('user')->subscribed('default')) {
            session('user')->newSubscription('default', config('services.stripe.plan'))->create($creditCardToken);
        }
    }
}
