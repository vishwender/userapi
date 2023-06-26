<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserImg;
use Illuminate\Support\Facades\Validator;

class UsersImg extends Controller
{
    public function register(Request $request){

        $fields = $request->all();

        $validator = Validator::make($fields, [
            'location_pincode'=>'required|numeric|digits:6',
            'phone_number'=>'required|numeric|digits:10',
            'media_link' => 'required|image:jpeg,png,jpg,gif,svg',
        ]);

        if($validator->fails()){
            $response = $validator->errors();
            return response($response, 500);       
        }
        
        $file = $request->file('media_link');
        $media_link = time().'.'.$file->extension();
        $imagePath = public_path(). '/files';
        $file->move($imagePath, $media_link);

        $userImg = UserImg::create([
            'location_pincode'=>$fields['location_pincode'],
            'phone_number'=>$fields['phone_number'],
            'media_link'=>$media_link,
            'is_checked'=>0,
            'is_downloaded'=>0,
            'is_deleted'=>0
        ]);

        $token = $userImg->createToken('usertoken')->plainTextToken;
        $response = [
            'user'=>$userImg,
            'token'=>$token
        ];

        return response($response, 201);
    }
}
