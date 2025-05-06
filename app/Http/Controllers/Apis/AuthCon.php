<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginR;
use App\Http\Requests\RegisterR;
use App\Models\PublicData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AuthCon extends Controller
{

    public function register(RegisterR $request)
    {

        $data = $request->validated();

        //user instance
        $user = new User();

        //create a new user
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

    public function login(LoginR $request)
    {

        //validation
        $data = $request->validated();

        //check for email
        $user = User::where('email', $data['email'])->first();

        //check function
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid Cred',
            ], 401);
        }

        //create token
        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'successful'
        ], 200);
    }
}
