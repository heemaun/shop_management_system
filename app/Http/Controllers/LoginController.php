<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('login-middleware')->only('logout');
    }

    public function login(Request $request)
    {
        $data = Validator::make($request->all(),[
            'user_name' => 'required|min:3',
            'password' => 'required|min:8|max:20',
        ]);

        if($data->fails()){
            return response()->json([
                'status' => 'errors',
                'errors' => $data->errors(),
            ]);
        }

        $data = $data->validate();

        $user = User::where('user_name',$data['user_name'])->first();

        if($user == null){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid user name',
            ]);
        }

        if(strcmp($user->status,'active') !== 0){
            $message = '';
            if(strcmp($user->status,'pending') == 0){
                $message = 'Please verify your email';
            }
            else if(strcmp($user->status,'deleted') == 0){
                $message = 'Your account has been deleted';
            }
            else if(strcmp($user->status,'banned') == 0){
                $message = 'Your account has been banned';
            }
            else{
                $message = 'Your account has been restricted';
            }
            return response()->json([
                'status' => 'error',
                'message' => $message,
            ]);
        }

        if(!Hash::check($data['password'],$user->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'Incorrect password',
            ]);
        }

        Session::put('user_id',$user->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
        ]);
    }

    public function logout()
    {
        Session::flush();

        return redirect(route('index'));
    }
}
