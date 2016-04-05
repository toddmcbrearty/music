<?php
Route::group(['middleware' => 'auth.api'], function() {
    Route::get('audio', 'AudioController@index');
    Route::post('audio', 'AudioController@store');
    Route::post('audio/{id}', 'AudioController@update');
});
