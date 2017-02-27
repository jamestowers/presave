<?php

use Illuminate\Http\Request;

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/campaigns/{slug}', 'CampaignController@showBySlug')->where('slug', '[A-Za-z]+');

Route::group(['middleware' => 'jwt.auth'], function () {
    
    Route::get('/user', 'UserController@me');

    Route::post('/upload', 'CampaignController@handleFileUpload');

    Route::resource('/campaigns', 'CampaignController');

    Route::get('/search', 'SpotifyAdminController@search');
});

//Route::get('/spotify-login', 'SpotifyController@login');
Route::get('/auth-url', 'SpotifyController@login');
Route::get('/spotify-user', 'SpotifyController@me');
Route::get('/get-albums', 'SpotifyController@getUserAlbums');
Route::get('/get-playlists', 'SpotifyController@getUserPlaylists');
Route::post('/follow', 'FanController@followCampaign');