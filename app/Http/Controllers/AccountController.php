<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(array_key_exists('key_sell',$request->all())){
            $accounts = Account::where('name','like','%'.$request->search.'%')
                                    ->where('shop_id',getUser()->shop_id)
                                    ->orderBy('name')
                                    ->limit(5)
                                    ->get();
            return response(view('sell.account-search-ul',compact('accounts')));
        }

        else if(array_key_exists('key',$request->all())){
            $results = Account::where('name','like','%'.$request->search.'%')
                                    ->where('shop_id',getUser()->shop_id)
                                    ->orderBy('name')
                                    ->limit(5)
                                    ->get();
            return response(view('transaction.search-ul',compact('results')));
        }

        else if(array_key_exists('search',$request->all())){
            $accounts = Account::where('name','like','%'.$request->search.'%')
                                    ->where('shop_id',getUser()->shop_id)
                                    ->orderBy('name')
                                    ->get();

            return response(view('account.search',compact('accounts')));
        }
        $accounts = Account::where('shop_id',getUser()->shop_id)
                                    ->orderBy('name')
                                    ->get();
        return response(view('account.index',compact('accounts')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('account.create'));
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
            'name'              => 'required|string|min:3|max:30',
            'initial_balance'   => 'required|numeric',
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

            $account = Account::create([
                'shop_id'           => getUser()->shop_id,
                'user_id'           => getUser()->id,
                'name'              => $data['name'],
                'initial_balance'   => $data['initial_balance'],
                'balance'           => $data['initial_balance'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Account added successfully',
                'url' => route('accounts.show',$account->id),
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
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return response(view('account.show',compact('account')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return response(view('account.edit',compact('account')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $data = Validator::make($request->all(),[
            'name'              => 'required|string|min:3|max:30',
            'initial_balance'   => 'required|numeric',
            'balance'           => 'required|numeric',
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

            $account->user_id          = getUser()->id;
            $account->name             = $data['name'];
            $account->initial_balance  = $data['initial_balance'];
            $account->balance          = $data['balance'];

            $account->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Account updated successfully',
                'url' => route('accounts.show',$account->id),
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
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account, Request $request)
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
                $account->delete();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Account deleted successfully',
                    'url' => route('accounts.index'),
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
