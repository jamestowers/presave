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

    public function setUser(Request $request)
    {
        $tokens = SpotifyAdmin::requestUserToken($request->get('code'));

        $spotify = new SpotifyWebAPI($tokens->access_token);
        $spotifyUser = $spotify->me();
        
        $user = $this->storeUser($spotifyUser, $tokens);
        
        if (Auth::loginUsingId($user->id, true)) {
            return redirect('/');
        } else {
            abort(401, 'Could not log user in');
        }
    }

    public function storeUser($spotifyUser, $tokens) {

        $user = \App\User::firstOrNew(['spotify_user_id' => $spotifyUser->id]);

        $user->name = $spotifyUser->display_name;
        $user->email = isset($spotifyUser->email) ? $spotifyUser->email : null;
        $user->access_token = $tokens->access_token;
        $user->refresh_token = $tokens->refresh_token;
        $user->expires_at = \Carbon\Carbon::now()->addSeconds($tokens->expires_in);
        $user->save();

        return $user;
    }

    public function getUserAlbums(Request $request) 
    {   
        if($request->has('token')) {

            $spotify = new SpotifyWebAPI($request->get('token'));
            //$this->spotify->setToken($request->get('token'));

            //$this->spotify->api->addMyAlbums('0xhcc6Lp1uTV4mokv50GXf');

            $albums = $spotify->getMySavedAlbums()->items;

            if($request->wantsJson()){
                return response()->json($albums);
            }

            return view('albums', compact('albums'));
        }
        else{
            abort(401, 'You are not logged in');
        }
    }
}
