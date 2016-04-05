<?php

Route::group(['middleware' => 'auth.api'], function() {
    Route::put('band/member', 'BandMemberController@store');
});