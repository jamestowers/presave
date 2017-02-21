<?php

use Illuminate\Http\Request;

Route::get('/login', 'SpotifyController@login');

Route::post('/campaigns/{slug}', 'CampaignController@showBySlug');

Route::post('/upload', 'CampaignController@handleFileUpload');

Route::get('/search', 'SpotifyAdminController@search');

Route::get('/get-albums', 'SpotifyController@getUserAlbums');

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/albums', 'UserController@albums');
