<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterR;
use App\Models\PublicData;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AuthCon extends Controller
{

    public function register(RegisterR $request)
    {

        $data = $request->validated();
        // $data = $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|string|unique:users,email',
        //     'password' => 'required|string'
        // ]);

        //user instance
        $user = new User();

        //create a new user
        // $user = User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => $data['password']
        // ]);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        //save
        $user->save();

        //token
        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json([
            'token' => $token,
            'data' => $user
        ]);
    }

    public function login()
    {
        $p = PublicData::all();
        return response()->json(['message' => $p]);
    }
}
