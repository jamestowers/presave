<?php

namespace App\Http\Controllers;
use Auth;
use SpotifyAdmin;
use App\Libraries\Spotify\SpotifyWebAPI;
use Illuminate\Http\Request;

class SpotifyController extends Controller
{

    public function __construct()
    {
        //
    }

    public function login(Request $request)
    {
        $authUrl = SpotifyAdmin::authUrl();

        if($request->wantsJson()){
            return response()->json($authUrl);
        }

        return view('login');
    }

    public function callback(Request $request)
    {
        $tokens = SpotifyAdmin::requestUserToken($request->get('code'));
        
        $fan = $this->storeFan($tokens);

        if(!$request->cookie('spotify_token')){
            $cookie = cookie(
                'spotify_token', 
                $tokens->access_token, 
                $tokens->expires_in/60,
                null, // path
                null, //domain
                false, // secure,
                false // httpOnly
            );
        }
   
        // Cant use $request->cookie() as Laravel encrypts cookies so 
        // we wont be able to access from JS
        if(isset($_COOKIE['campaign_slug'])){ 
            $redirectTo = route('campaign', $_COOKIE['campaign_slug']);
        }else{
            $redirectTo = '/campaign';
        }
        return redirect($redirectTo)->cookie($cookie);
    }

    public function storeFan($tokens) {

        $spotify = new SpotifyWebAPI($tokens->access_token);
        $user = $spotify->me();

        $fan = \App\Fan::firstOrNew(['email' => $user->email]);
        $fan->name = $user->display_name;
        $fan->spotify_user_id = $user->id;
        $fan->email = $user->email;
        $fan->access_token = $tokens->access_token;
        $fan->refresh_token = $tokens->refresh_token;
        $fan->expires_at = \Carbon\Carbon::now()->addSeconds($tokens->expires_in);
        $fan->save();

        return $fan;
    }

    public function getUserAlbums(Request $request) 
    {   
        if($request->has('token')) {

            $spotify = new SpotifyWebAPI($request->get('token'));

            $albums = $spotify->getMySavedAlbums()->items;

            if($request->wantsJson()){
                $sorted = array_map(function($p) { return ['id' => $p->id, 'name' => $p->name]; }, $albums);
                return response()->json($albums);
            }

            return view('albums', compact('albums'));
        }
        else{
            abort(401, 'You are not logged in');
        }
    }

    public function getUserPlaylists(Request $request) 
    {   
        if($request->has('token')) {

            $spotify = new SpotifyWebAPI($request->get('token'));

            $playlists = $spotify->getMyPlaylists()->items;

            if($request->wantsJson()){
                $sorted = array_map(function($p) { return ['id' => $p->id, 'name' => $p->name]; }, $playlists);
                return response()->json($sorted);
            }

            return view('playlists', compact('playlists'));
        }
        else{
            abort(401, 'You are not logged in');
        }
    }
}
