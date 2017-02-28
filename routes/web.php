<?php

//Auth::routes();

//Route::get('/', 'CampaignController');

Route::group(['domain' => '{slug}' . config('session.domain')], function () {
    Route::get('/', 'CampaignController@showBySlug');
});

Route::get('/callback', 'SpotifyController@callback');

Route::get('/user', 'UserController@getUser');

Route::get('/campaigns/{id}', 'CampaignController@show')->where('id', '[0-9]+');

Route::group(['middleware' => 'jwt.auth'], function()
{
    Route::resource('/campaigns', 'CampaignController',['except' => [
        'show', 'showBySlug'
    ]]);
});

Route::get('/campaigns/{slug}', 'CampaignController@showBySlug')
    ->where('slug', '[A-Za-z]+')
    ->name('campaign');

Route::get('/{vue_capture?}', function () {
   return view('vue-template');
})->where('vue_capture', '[\/\w\.-]*');