<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function register(Request $request){
        // $validated=$request->validate([
        //     'name'=>'required|string|max:255',
        //     'email'=>'required|string|email|max:255|unique:users',
        //     'password'=>'required|string|min:6',
        // ]);
        $validated=Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6',   
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(),403);
        }
        try{
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);
            $token= $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token'=>$token,
                'user'=>$user
            ],200);
        }catch(\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],403);
        }
        
    }
    public function login(Request $request){
        $validated=Validator::make($request->all(),[
            'email'=>'required|string|email|max:255',
            'password'=>'required|string|min:6',   
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(),403);
        }
        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password
        ];
        try {
            if(!auth()->attempt($credentials)){
            return response()->json(['error'=>'invalid credentials'],403);
            }
            $user=User::where('email',$request->email)->firstOrFail();
            $token=$user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token'=>$token,
                'user'=>$user
            ],200);
        } catch (\Exception $th) {
            return response()->json(['error'=>$th->getMessage()],403);
        }
    }
    public function logout(Request $request){
       
        $user=$request->user();
        if(!$user){
            return response()->json([
                'message'=>'user not found'
            ]);
        }
        $request->user()->currentAccessToken()->delete();
        $user->delete();
        return response()->json([
            'message'=>'user has been logged out successfully'
        ],200);
    }
}
