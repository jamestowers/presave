<?php

namespace App\Http\Controllers;

//use App\Libraries\SpotifyAPI;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{

    protected $spotify;

    public function __construct()
    {
        //
    }

    public function getUser()
    {
        if(Auth::check()){
            return [ 'user' => Auth::user() ];
        } else {
            return [ 'user' => false ];
        }
    }

    /*public function getToken($code)
    {
        $this->spotify->requestToken($request->get('code'));
    }*/


}
