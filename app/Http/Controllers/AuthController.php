<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            "name" => "required|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);

        $user = User::create($fields);

        $token = $user->createToken($request->name);

        return [
            "message" => "User created sucessfully",
            "user" => $user,
            "token" => $token->plainTextToken
        ];
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required"
        ]);

        $user = User::whwre("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ["message", "The provided credentials are incorrect."];
        }
    }

    public function logout()
    {
        return "logout";
    }
}
