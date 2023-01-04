<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(array_key_exists('key',$request->all())){
            $results = User::where('name','like','%'.$request->search.'%')
                                    ->where('shop_id',getUser()->shop_id)
                                    ->orderBy('name')
                                    ->limit(5)
                                    ->get();
            return response(view('transaction.search-ul',compact('results')));
        }
        else if(array_key_exists('search',$request->all())){

            if(strcmp($request->status,'all')==0){
                $status = ['pending','active','deleted','banned','restricted'];
            }
            else{
                $status = [$request->status];
            }

            if(strcmp($request->role,'all')==0){
                if(checkSuperAdmin()){
                    $roles = ['super_admin','admin','manager','seller','customer'];
                }
                else if(checkAdmin()){
                    $roles = ['admin','manager','seller','customer'];
                }
                else{
                    $roles = ['seller','customer'];
                }
            }
            else{
                $roles = [$request->role];
            }

            $users = User::where('name','LIKE','%'.$request->search.'%')
                            ->whereIn('status',$status)
                            ->whereIn('role',$roles)
                            ->where('shop_id',getUser()->shop_id)
                            ->orderBy('role')
                            ->orderBy('status')
                            ->orderBy('name')
                            ->get();

                            return response(view('user.search',compact('users')));

                        }
        $users = User::where('shop_id',getUser()->shop_id)
                        ->orderBy('role')
                        ->orderBy('status')
                        ->orderBy('name')
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
        // return response()->json([
        //     'status' => 'errors',
        //     'errors' => $request->all(),
        // ]);
        $data = Validator::make($request->all(),[
            'name'          => 'required|string|min:3|max:30',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|numeric|unique:users,phone',
            'user_name'     => 'required|unique:users,user_name',
            'status'        => 'nullable',
            'role'          => 'nullable',
            'gender'        => 'required',
            'salary'        => 'nullable|numeric',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d',
            'picture'       => 'nullable:picture,string|image|mimes:jpeg,jpg,gif,svg,png|max:2048',
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

            $user = User::create([
                'shop_id'       => (getUser() !== null) ? getUser()->shop_id : 1,
                'name'          => $data['name'],
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'user_name'     => $data['user_name'],
                'password'      => Hash::make('11111111'),
                'gender'        => $data['gender'],
                'date_of_birth' => $data['date_of_birth'],
                'picture'       => "",
                'address'       => $data['address'],
            ]);

            if(array_key_exists('status',$data)){
                $user->status = $data['status'];
            }

            if(array_key_exists('role',$data)){
                $user->role = $data['role'];
            }

            if(array_key_exists('salary',$data)){
                $user->salary = $data['salary'];
            }

            if(array_key_exists('picture',$data)){
                $imageName = time().'.'.$data['picture']->extension();

                $data['picture']->move(public_path('images'),$imageName);

                $user->picture = $imageName;
            }

            $user->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'User added successfully',
                'url'       => route('users.show',$user->id),
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
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'phone'         => 'required|numeric|unique:users,phone,'.$user->id,
            'user_name'     => 'required|unique:users,user_name,'.$user->id,
            'status'        => 'required',
            'gender'        => 'required',
            'salary'        => 'nullable|numeric',
            'date_of_birth' => 'nullable|date',
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

            $user->name             = $data['name'];
            $user->email            = $data['email'];
            $user->phone            = $data['phone'];
            $user->user_name        = $data['user_name'];
            $user->status           = $data['status'];
            $user->gender           = $data['gender'];
            $user->salary           = $data['salary'];
            $user->date_of_birth    = $data['date_of_birth'];
            $user->address          = $data['address'];

            $user->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'User updated successfully',
                'url'       => route('users.show',$user->id),
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function changeUserImage(Request $request, User $user)
    {
        $data = Validator::make($request->all(),[
            'picture' => 'nullable:picture,string|image|mimes:jpeg,jpg,gif,svg,png|max:2048',
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

            File::delete(public_path('images/'.$user->picture));

            $imageName = time().'.'.$data['picture']->extension();
            $data['picture']->move(public_path('images'),$imageName);
            $user->picture = $imageName;

            $user->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'User picture updated successfully',
                'url' => route('users.show',$user->id)
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
            $data = $data->validate();

            if(Hash::check($data['password'],getUser()->password)){
                $user->status = 'deleted';

                $user->save();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'User deleted successfully',
                    'url'       => route('users.index'),
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
