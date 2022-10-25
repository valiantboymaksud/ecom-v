<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    /*
     |--------------------------------------------------------------------------
     | LOGIN
     |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'username'      =>  'required',
            'password'      =>  'required',
        ]);


        if ($validator->fails()) {

            return response()->json([

                'data'      => $validator->errors()->first(),
                'message'   => "Validation Error",
                'status'    => 0,
            ]);
        }



        // check username
        $user = User::where('username', $request->username)->orWhere('phone', $request->username)->orWhere('email', $request->username)->first();

        // check user is exist or not
        if (!$user) {

            return response()->json([

                'data'      => "User Not Found",
                'message'   => "Error",
                'status'    => 0,
            ]);
        }

        // check user is exist or not
        if ($user->status == 0) {

            return response()->json([

                'data'      => "User is Deactivated",
                'message'   => "Error",
                'status'    => 0,
            ]);
        }




        // check password
        if(!Hash::check($request->password, $user->password)) {

            return response()->json([

                'data'      => "Password Not Match",
                'message'   => "Validation Error",
                'status'    => 0,
            ]);
        }



        // create bearer token for authentication
        Auth::login($user);
        
        $data['token']  = auth()->user()->createToken('myapptoken')->accessToken;
        $data['user']   = $user;


        return response()->json([

            'data'      => $data,
            'message'   => "Success",
            'status'    => 1,
        ]);
    }

    /*
     |--------------------------------------------------------------------------
     | CHECK LOGIN
     |--------------------------------------------------------------------------
    */
    public function checkLogin(Request $request)
    {

        return auth()->user();

    }

}
