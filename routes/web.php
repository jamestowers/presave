<?php

//Auth::routes();

//Route::get('/', 'CampaignController');

Route::group(['domain' => '{slug}.presave.tracks2.com'], function () {
    Route::get('/', 'CampaignController@showBySlug')->name('campaign');
});

Route::get('/callback', 'SpotifyController@callback');

Route::get('/user', 'UserController@getUser');

Route::group(['middleware' => 'jwt.auth'], function()
{
    Route::resource('/campaigns', 'CampaignController');
});

Route::get('/{vue_capture?}', function () {
   return view('vue-template');
})->where('vue_capture', '[\/\w\.-]*');