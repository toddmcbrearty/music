<?php

use App\Music\Audio\Audio;

Route::put('user/register', [
    'uses' => 'Auth\RegisterController@registerUser',
    'as' => 'register_user',
]);


Route::get('test', function() {
    $audio = new Audio;
    $path = storage_path('media/tests/audio');
    $audio = $audio->make("{$path}/cache/280.m4a");

    dd($audio);
});