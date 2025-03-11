<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\State;
use App\Models\User;

class LoginController extends Controller
{
    public function create(){
        return view('login');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',     
        ]);
 
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator)->withInput();
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }

        if(Auth::attempt($request->only(['email', 'password']))){
            // return redirect()->route('dashboard');

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Login successful!',
                'token' => $token
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Email & Password does not match with our record.',
        ], 401);

        // return redirect()->route('login')->withError('Email & Password does not match with our record.');        
    }

    public function logout(Request $request){
    //    dd(auth()->user()->currentAccessToken());
    // auth::logout();
        //  auth()->user()->token()->delete();
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout successful!'
        ], 200);
        // return view('login');
    }

    public function dashboard(){
        return view('dashboard');
    }
}
