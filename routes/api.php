<?php

use Illuminate\Http\Request;

Route::get('/spotify-login', 'SpotifyController@login');

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/campaigns/{slug}', 'CampaignController@showBySlug');

Route::group(['middleware' => 'jwt.auth'], function () {
    
    Route::get('/user', 'UserController@me');

    Route::post('/upload', 'CampaignController@handleFileUpload');

    Route::get('/search', 'SpotifyAdminController@search');
});


Route::get('/get-albums', 'SpotifyController@getUserAlbums');

/*Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::get('/albums', 'UserController@albums');
