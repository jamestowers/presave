<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function register(RegisterFormRequest $request)
    {
        $user = User::create([
            'name' => $request->json('name'),
            'email' => $request->json('email'),
            'password' => bcrypt($request->json('password')),
        ]);

        return response()->json([
            'data' => $user
        ]);
    }

}
