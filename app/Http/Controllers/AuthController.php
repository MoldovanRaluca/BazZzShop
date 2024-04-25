<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
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

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->is_admin) {//daca nu e admin
            Auth::logout();//deconectare
            return response([
                'message' => 'Nu aveți permisiunea să vă autentificați ca administrator.'
            ], 403);
        }
        $token = $user->createToken('main')->plainTextToken;//creeam un token de acces pt utilizatorul autentificat
        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);

    }

    public function logout(){
        /** @var \App\Models\User $user */
        error_log("hello");
        $user = Auth::user();
        echo($user);
        $user->currentAccessToken()->delete();

        return response('',204);
    }

    public function getUser(Request $request)
    {
        return new UserResource($request->user());
    }
}
