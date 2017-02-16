<?php

namespace App\Http\Controllers;
use Auth;
use App\Libraries\SpotifyAPI;
use Illuminate\Http\Request;

class SpotifyController extends Controller
{
    protected $spotify;

    protected $userScopes = [
        'user-read-email',
        'user-library-read',
        'user-library-modify',
        'playlist-modify-public',
        'playlist-modify-private'
    ];

    public function __construct(SpotifyAPI $spotify)
    {
        $this->spotify = $spotify;
    }

    public function login(Request $request)
    {
        $authUrl = $this->spotify->session->getAuthorizeUrl(['scope' => $this->userScopes]);

        if($request->wantsJson()){
            return response()->json($authUrl);
        }

        return view('login');
    }

    public function setUser(Request $request)
    {
        $tokens = $this->spotify->requestToken($request->get('code'));

        $this->spotify->setToken($tokens['access_token']);

        $spotifyUser = $this->spotify->api->me();

        $user = $this->storeUser($spotifyUser, $tokens);
        
        if (Auth::loginUsingId($user->id, true)) {
            //return Redirect::route('getManageCompanyEmployee', ['page' => 3])
            return redirect()->back();
        }
        else{
            abort(401, 'Could not log user in');
        }
    }

    public function storeUser($spotifyUser, $tokens) {

        $user = \App\User::firstOrNew(['spotify_user_id' => $spotifyUser->id]);

        $user->name = $spotifyUser->display_name;
        $user->email = isset($spotifyUser->email) ? $spotifyUser->email : null;
        $user->access_token = $tokens['access_token'];
        $user->refresh_token = $tokens['refresh_token'];
        $user->save();

        return $user;
    }

    public function getUserAlbums(Request $request) 
    {   
        if($request->has('token')) {

            $this->spotify->setToken($request->get('token'));

            //$this->spotify->api->addMyAlbums('0xhcc6Lp1uTV4mokv50GXf');

            $albums = $this->spotify->api->getMySavedAlbums()->items;

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
