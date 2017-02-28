<?php

//Auth::routes();

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

Route::get('/images/{size}/{name}', function($size = NULL, $name = NULL)
{
    // http://blog.nedex.io/dynamic-thumbnail-image-compression-on-laravel-5/
    if(!is_null($size) && !is_null($name)){
        // Use config - see config/images.php
        $sizes = config('image.sizes.'.$size);

        $cache_image = Image::cache(function($image) use($sizes, $name){

            $url = url('/uploads/'.$name);

            if(isset($sizes['fit']) && $sizes['fit']){
              $resized = $image->make($url)
                ->fit( $sizes['width'], $sizes['height'], function ($constraint) {
                  $constraint->upsize();
                });
            }
            elseif(isset($sizes['crop']) && $sizes['crop']){
              $resized = $image->make($url)
                ->fit( $sizes['width'], $sizes['height'] );
            }else{
              $resized = $image->make($url)
                ->resize($sizes['width'], null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            return $resized;

        }, 60*24*30); // cache for 30 days

        return Response::make($cache_image, 200, ['Content-Type' => 'image']);
    } else {
        \App::abort('404', 'The requested image cannot be found');
    }
});

Route::get('/{vue_capture?}', function () {
   return view('vue-template');
})->where('vue_capture', '[\/\w\.-]*');