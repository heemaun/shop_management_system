<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($from_account =null, $to_account = null, $from_user =null, $to_user = null, $from_select = null, $to_select = null)
    {
        $transactions = Transaction::join('accounts as f_accounts','f_accounts.id', '=', 'transactions.from_account')
                                    ->join('accounts as t_accounts','t_accounts.id', '=', 'transactions.to_account')
                                    ->join('users as f_users','f_users.id', '=', 'transactions.from_user')
                                    ->join('users as t_users','t_users.id', '=', 'transactions.to_user')
                                    ->where('f_accounts.name',$from_account)
                                    ->orWhere('t_accounts.name',$to_account)
                                    ->orWhere('f_users.name',$from_user)
                                    ->orWhere('t_users.name',$to_user)
                                    ->get();
        return response(view('transaction.index',compact('transactions')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('transaction.create'));
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
            'from_account'  => 'required_if:from_select,account',
            'to_account'    => 'required_if:to_select,account',
            'from_user'     => 'required_if:from_select,user',
            'to_user'       => 'required_if:to_select,user',
            'from_select'   => 'required',
            'to_select'     => 'required',
            'amount'        => 'required|min:1|numeric',
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

            Transaction::create([
                'shop_id'       => getUser()->shop_id,
                'user_id'       => getUser()->user_id,
                'from_account'  => $data['from_account'],
                'to_account'    => $data['to_account'],
                'from_user'     => $data['from_user'],
                'to_user'       => $data['to_user'],
                'from_select'   => $data['from_select'],
                'to_select'     => $data['to_select'],
                'amount'        => $data['amount'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction added successfully',
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return response(view('transaction.show',compact('transaction')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return response(view('transaction.edit',compact('transaction')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = Validator::make($request->all(),[
            'from_account'  => 'required_if:from_select,account',
            'to_account'    => 'required_if:to_select,account',
            'from_user'     => 'required_if:from_select,user',
            'to_user'       => 'required_if:to_select,user',
            'from_select'   => 'required',
            'to_select'     => 'required',
            'amount'        => 'required|min:1|numeric',
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

            $transaction->user_id       = getuser()->id;
            $transaction->from_account  = $data['from_account'];
            $transaction->to_account    = $data['to_account'];
            $transaction->from_user     = $data['from_user'];
            $transaction->to_user       = $data['to_user'];
            $transaction->from_select   = $data['from_select'];
            $transaction->to_select     = $data['to_select'];
            $transaction->amount        = $data['amount'];

            $transaction->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Transaction updated successfully',
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction, Request $request)
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
                $transaction->delete();

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
