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

    public function me(Request $request)
    {
        $data = [];
        $data['name'] = $request->user()->name;
        $data['email'] = $request->user()->email;
        return response()->json([
            'data' => $data,
        ]);
    }

    public function getUser()
    {
        if(Auth::check()){
            return [ 'user' => Auth::user() ];
        } else {
            return [ 'user' => false ];
        }
    }

}
