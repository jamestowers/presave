<?php

Auth::routes();

Route::group(['domain' => '{slug}.presaver.dev'], function () {
    Route::get('/', 'CampaignController@showBySlug');
});

Route::get('/callback', 'SpotifyController@setUser');

Route::get('/user', 'UserController@getUser');

Route::group(['middleware' => 'auth'], function()
{
    Route::resource('/campaigns', 'CampaignController');
});

Route::get('/{vue_capture?}', function () {
   return view('vue-template');
 })->where('vue_capture', '[\/\w\.-]*');