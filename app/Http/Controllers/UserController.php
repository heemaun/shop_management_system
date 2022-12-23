<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($key = null, $status = null)
    {
        $users = User::where('email',$key)
                        ->orWhere('name',$key)
                        ->orWhere('phone',$key)
                        ->where('status',$status)
                        ->where('shop_id',getUser()->shop_id)
                        ->get();
        return response(view('user.index',compact('users')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('user.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Validator::make($request->all(),[
            'name'          => 'required|string|min:3|max:30',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|numeric|unique:users,phone',
            'user_name'     => 'required|unique:users,user_name',
            'password'      => 'required|string|min:8|max:20',
            // 'status'        => 'required',
            'gender'        => 'required',
            'salary'        => 'nullable|numeric',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d',
            'picture'       => 'nullable|string',
            'address'       => 'required|string',
        ]);


        if($data->fails()){
            return response()->json([
                'status' => 'errors',
                'errors' => $data->errors(),
            ]);
        }

        DB::beginTransaction();

        try{
            $data = $data->validate();

            User::create([
                'shop_id'       => 1,
                'name'          => $data['name'],
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'user_name'     => $data['user_name'],
                'password'      => Hash::make($data['password']),
                'status'        => 'pending',
                'gender'        => $data['gender'],
                'salary'        => 0,
                'date_of_birth' => $data['date_of_birth'],
                'picture'       => "",
                'address'       => $data['address'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'User added successfully',
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response($user);
        return response(view('user.show',compact('user')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response(view('user.edit',compact('user')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = Validator::make($request->all(),[
            'name'          => 'required|string|min:3|max:30',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|numeric|unique:users,phone',
            'user_name'     => 'required|unique:users,user_name',
            'password'      => 'required|string|min:8|max:20',
            'status'        => 'required',
            'gender'        => 'required',
            'salary'        => 'nullable|numeric',
            'date_of_birth' => 'nullable|date',
            'picture'       => 'nullable|string',
            'address'       => 'required|text',
        ]);

        if($data->fails()){
            return response()->json([
                'status' => 'errors',
                'errors' => $data->errors(),
            ]);
        }

        DB::beginTransaction();

        try{
            $data->validate();

            $user->name             = $data['name'];
            $user->email            = $data['email'];
            $user->phone            = $data['phone'];
            $user->user_name        = $data['user_name'];
            $user->password         = Hash::make($data['password']);
            $user->status           = $data['status'];
            $user->gender           = $data['gender'];
            $user->salary           = $data['salary'];
            $user->date_of_birth    = $data['date_of_birth'];
            $user->picture          = $data['picture'];
            $user->address          = $data['address'];

            $user->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        $data = Validator::make($request->all(),[
            'password' => 'required|min:8|max:20',
        ]);

        if($data->fails()){
            return response()->json([
                'status' => 'errors',
                'errors' => $data->errors(),
            ]);
        }

        DB::beginTransaction();

        try{
            $data->validate();

            if(Hash::check($data['password'],getUser()->password)){
                $user->delete();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'User deleted successfully',
                ]);
            }

            DB::rollBack();

            return response()->json([
                'status'    => 'error',
                'message'   => 'Incorrect password',
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }
}
