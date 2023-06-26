<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Users extends Controller
{
    public function signup(Request $request){
        $fields = $request->all();

        $validator = Validator::make($fields, [
            'mobile'=>'required|numeric|digits:10',
            'email'=>'required|email|unique:users',
            'name'=>'required',
            'password' => 'required',
            'name'=>'required',
        ]);

        if($validator->fails()){
            $response = $validator->errors();
            return response($response, 500);       
        }

        $user = User::create([
            'mobile'=>$fields['mobile'],
            'email'=>$fields['email'],
            'name'=>$fields['name'],
            'password'=>bcrypt($fields['password']),
            'is_active'=>0,
            'is_deleted'=>0
        ]);

        $token = $userImg->createToken('usertoken')->plainTextToken;
        $response = [
            'user'=>$user,
            'token'=>$token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $fields = $request->all();

        $validator = Validator::make($fields, [
            'mobile'=>'required|numeric|digits:10',
        ]);
        if($validator->fails()){
            $response = $validator->errors();
            return response($response, 500);       
        }
        $user = User::where('mobile', $fields['mobile'])->first();
        
        if(!$user) {
            return response(['status'=>false,'message' => 'phone number not registered'], 401);
        }else{
            $token = $user->createToken('usertoken')->plainTextToken;
            $response = [
            'status'=>true,    
            'token'=>$token
            ];
            return response($response, 201);
        }
    }

    public function checkPassword(Request $request){
        $fields = $request->all();

        $validator = Validator::make($fields, [
            'password'=>'required',
        ]);
        if($validator->fails()){
            $response = $validator->errors();
            return response($response, 500);       
        }

        $user = User::where('id', $fields['id'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'status'=>false,
                'message' => 'password did not match'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'status'=>true,
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
