<?php

use Illuminate\Http\Request;

Route::get('/login', 'SpotifyController@login');

Route::get('/search', 'SpotifyAdminController@search');

Route::get('/get-albums', 'SpotifyController@getUserAlbums');

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/albums', 'UserController@albums');
