<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\State;
use App\Models\User;
use App\Models\City;

class RegisterController extends Controller
{

    public function create(){
        $states = State::all();
        return view('register', compact('states'));
    }

    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',            
        ]);
 
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator)->withInput();
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'state_id' => $request->state,
            'city_id' => $request->city
        ]);

        // return redirect()->route('login')->with('success', 'Registration successful!');  

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'Registration successful!',
            'token' => $token
        ], 200);      
    }

    public function cities($id){
        $cities = City::where('state_id', $id)->get();
        return response()->json($cities);
    }
}

