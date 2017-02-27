<?php

//Auth::routes();

//Route::get('/', 'CampaignController');

Route::group(['domain' => '{slug}' . config('session.domain')], function () {
    Route::get('/', 'CampaignController@showBySlug')->name('campaign');
});

Route::get('/callback', 'SpotifyController@callback');

Route::get('/user', 'UserController@getUser');

Route::get('/campaigns/{id}', 'CampaignController@show');

Route::group(['middleware' => 'jwt.auth'], function()
{
    Route::resource('/campaigns', 'CampaignController',['except' => [
        'show', 'showBySlug'
    ]]);
});

Route::get('/{vue_capture?}', function () {
   return view('vue-template');
})->where('vue_capture', '[\/\w\.-]*');