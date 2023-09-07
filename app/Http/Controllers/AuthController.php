<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Drivers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function signup(Request $request){
        $validated = $request->validate([
           'username' => 'required|unique:customers',
           'email'=>'required|email|unique:customers',
           'password'=>'required|min:6' 
        ]);

        if(isset($request->type) && ($request->type == 1))
        {
            // driver > 1 
            // customer > 0

            try {
                $driver = Drivers::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                $driver->type = 1;
                return response()->json([
                    'message' => 'signup',
                    'user'=> $driver
                ]);
            } catch (\Throwable $e) {
                //Need to Check for error return
                return response()->json([
                    'message'=>'error',
                    'error'=> $e
                ]);
            }
        }else{
            try {
                $customer = Customers::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                $customer->type = 0;

                return response()->json([
                    'message' => 'signup',
                    'user'=> $customer
                ]);
            } catch (\Throwable $e) {
                //Need to Check for error return
                return response()->json([
                    'message'=>'error',
                    'error'=> 'fail'
                ]);
            }
        }

    }
    
    public function signin(Request $request){
        $validated = $request->validate([
            'email'=>'required|email',
            'password'=>'required' 
         ]);
         $email = $request->email;
         $password = $request->password;
 
         if(isset($request->type) && ($request->type == 1))
         {
             // driver > 1 
             // customer > 0
 
             try {
                 $driver = Drivers::where('email', $email)->first();
                 if (!$driver || !Hash::check($request->password, $driver->password)){
                         return response()->json([
                             'error'=> 'Invalid Credentials'
                         ]);
                 }
                 $driver->type = 1;
                 return response()->json([
                     'message'=>'signin',
                     'user'=>$driver,
                 ]);
             } catch (\Throwable $e) {
                 //Need to Check for error return
                 return response()->json([
                     'message'=>'error',
                     'error'=> $e
                 ]);
             }
         }else{
             try {
                $customer = Customers::where('email', $email)->first();
                if (!$customer || !Hash::check($request->password, $customer->password)){
                        return response()->json([
                            'error'=> 'Invalid Credentials'
                        ]);
                }
                $customer->type = 0;
                return response()->json([
                    'message'=>'signin',
                    'user'=>$customer,
                ]);
             } catch (\Throwable $e) {
                 //Need to Check for error return
                 return response()->json([
                     'message'=>'error',
                     'error'=> 'fail'
                 ]);
             }
         }
    }
    
}
