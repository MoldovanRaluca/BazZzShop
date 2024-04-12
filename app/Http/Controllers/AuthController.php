<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
            'remember' => 'boolean'
        ]);
        $remember = $credentials['remember'] ?? false; //daca nu bifat, ii atribuim val 'false'
        unset($credentials['remember']);//elimina cheia 'remember' din array-ul $credentials
        if (!Auth::attempt($credentials, $remember)) {//daca nu functioneaza logarea
            return response([
                'message' => "Email sau parolă incorectă"
            ], 422);
        }

        /** @var User $user */
        $user = Auth::user();
        if (!$user->is_admin) {//daca nu e admin
            Auth::logout();//deconectare
            return response([
                'message' => 'Nu aveți permisiunea să vă autentificați ca administrator.'
            ], 403);
        }
        $token = $user->createToken('main')->plainTextToken;//creeam un token de acces pt utilizatorul autentificat
        return response([
            'user' => $user,
            'token' => $token
        ]);

    }

    public function logout(): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        /** @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response('',204);
    }
}
