<?php

namespace App\Http\Controllers;

use SpotifyAdmin;
use Illuminate\Http\Request;
class SpotifyAdminController extends SpotifyController
{
    public function search(Request $request)
    {
        $results = SpotifyAdmin::search($request->get('term'), $request->get('type'));
        
        return response()->json($results);
    }
}