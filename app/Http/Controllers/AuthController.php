<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
   public function me(){
       return [
        'NIS' => 3103119179,
        'Name' => 'Shabrina Talita Kuswoyo',
        'Gender' => 'Female',
        'Phone' => '081225145323',
        'Class' => 'XII RPL 6'
       ];
    
   }
   public function register(Request $request){
    $input = $request->all();
    $validate = Validator::make($input, [
        'name' => 'required |string|max:225',
        'email' => 'required|string|email|unique:users|max:225',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validate->fails()) {
        return response()->json(['error' => $validate->errors()]);
    }

    $input['password'] = Hash::make($request->password);
    $user = User::create($input);
    $token = $user->createToken('authToken')->plainTextToken;
    return response()->json(['access_token' => $token], 201);
}
public function login( Request $request){
    $input = $request->all();

    $validate = Validator::make($input,[
        'email'=> 'required|email',
        'password' => 'required'
    ]);

    if ($validate->fails()) {
        return response()->json(['error' => $validate->errors()]);
    }
    $user = User::where('email',$input['email'])->firstOrFail();
    if (Hash::check($input['password'],$user['password'])) {
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
           'access_token' => $token,
        ],202);
    }
    $error = [
        'password' => 'Email or Password is incorrect'
    ];
    return response()->json(['error'=>$error]);
}
public function logout(Request $request){
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logout success']);
}
}
