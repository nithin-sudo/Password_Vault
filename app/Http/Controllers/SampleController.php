<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Validator;


class SampleController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|between:2,50',
            'url' => 'required|string|between:3,100',
            'username' => 'required|string|between:3,100',
            'password' => 'required|string|between:3,100',
            'user_id' => 'required|string'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::where('id','=',$request->user_id)->get();
        logger($user);
        if($user == '[]')
        {
            return response()->json([
                "message" => "User Not Found"
            ],401);
        }
        $vault = new Vault;
        $vault->title = $request->input('title');
        $vault->url = $request->input('url');
        $vault->username = $request->input('username');
        $vault->password = Crypt::encryptString($request->input('password'));
        $vault->user_id = $request->user_id;
        $vault->save();

        return response()->json([
            'message' => "Site created successfully"
        ],200);
    }
}
