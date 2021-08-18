<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;




class AuthController extends Controller
{
    public function register(Request $request) {
      $validator = Validator::make($request->all(), [
             'name' => 'required|max:55',
             'email' => 'email|required|unique:users',
             'password' => 'required|confirmed'
          ]);
      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors()
          ]);
      }
      $data = $request->all();
      $user = User::create($data);
      $token = JWTAuth::fromUser($user);
      return response([ 'user' => $user, 'access_token' => $token]);
    }

    public function login(Request $request) {
      $credentials = $request->all();

      if ($token = JWTAuth::attempt($credentials)) {
          $user = Auth::user();
          return response()->json([
              'success' => true,
              'token' => $token,
              'user' => $user,
              'expires' =>  \Carbon\Carbon::now()->addDays(7)->timestamp,
              'message' => 'Auth Success'
          ]);
      } else {
          return response()->json([
              'success' => false,
              'message' => 'Invalid Credentials'
          ], 401);
      }
    }

    public function logout(Request $request) {
      $request->user()->token()->revoke();
      return response()->json([
        'message' => 'Successfully logged out'
      ]);
    }

    public function user(Request $request) {
      return response()->json($request->user());
    }
}
