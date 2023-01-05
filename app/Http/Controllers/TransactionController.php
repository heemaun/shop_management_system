<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Account;
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
    public function index(Request $request)
    {
        if(array_key_exists('search_text',$request->all())){

            if(strcmp($request->type,'all')!==0){
                $type_array = [$request->type];
            }
            else{
                $type_array = ['sell','purchase','salary','deposite','withdraw','transfer','other'];
            }

            if(strcmp($request->status,'all')!==0){
                $status_array = [$request->status];
            }
            else{
                $status_array = ['active','pending','deleted','banned','restricted'];
            }

            if($request->search_type === null){
                $transactions = Transaction::whereIn('status',$status_array)
                                                ->whereBetween('created_at',[$request->from,$request->to])
                                                ->whereIn('type',$type_array)
                                                ->orderBy('created_at','DESC')
                                                ->get();
                return response(view('transaction.search',compact('transactions')));
            }

            $users = User::where('name','LIKE','%'.$request->search_text.'%')
                            ->orderBy('name')
                            ->get();
            $users_id_array = array();
            $accounts = Account::where('name','LIKE','%'.$request->search_text.'%')
                                    ->orderBy('name')
                                    ->get();
            $accounts_id_array = array();

            if(strcmp('user',$request->search_type)==0){
                foreach($users as $user){
                    array_push($users_id_array,$user->id);
                }
            }

            else{
                foreach($accounts as $account){
                    array_push($accounts_id_array,$account->id);
                }
            }

            $transactions = Transaction::where(
                                            function($query) use ($request,$users_id_array,$accounts_id_array){
                                                $query->whereIn('from_'.$request->search_type, (strcmp('user',$request->search_type)==0)? $users_id_array : $accounts_id_array)
                                                        ->orWhereIn('to_'.$request->search_type,(strcmp('user',$request->search_type)==0)? $users_id_array : $accounts_id_array);
                                            }
                                        )
                                        ->whereIn('status',$status_array)
                                        ->whereIn('type',$type_array)
                                        ->whereBetween('created_at',[$request->from,$request->to])
                                        ->orderBy('created_at','DESC')
                                        ->get();
            return response(view('transaction.search',compact('transactions')));
        }

        $transactions = Transaction::orderBy('created_at','DESC')->get();

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
            'from_id'       => 'required',
            'to_id'         => 'required',
            'sell_id'       => 'required_if:type,sell',
            'purchase_id'   => 'required_if:type,purchase',
            'from_select'   => 'required',
            'to_select'     => 'required',
            'status'        => 'required',
            'type'          => 'required',
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
            $data = $data->validate();

            $transaction = Transaction::create([
                'shop_id'       => getUser()->shop_id,
                'user_id'       => getUser()->id,
                'from_account'  => (strcmp('user',$data['from_select'])==0) ? null : $data['from_id'],
                'to_account'    => (strcmp('user',$data['to_select'])==0) ? null : $data['to_id'],
                'from_user'     => (strcmp('user',$data['from_select'])==0) ? $data['from_id'] : null,
                'to_user'       => (strcmp('user',$data['to_select'])==0) ? $data['to_id'] : null,
                'sell_id'       => (array_key_exists('sell_id',$data)) ? $data['sell_id'] : null,
                'purchase_id'   => (array_key_exists('purchase_id',$data)) ? $data['purchase_id'] : null,
                'from_select'   => $data['from_select'],
                'to_select'     => $data['to_select'],
                'status'        => $data['status'],
                'type'          => $data['type'],
                'amount'        => $data['amount'],
            ]);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Transaction added successfully',
                'url'       => route('transactions.show',$transaction->id),
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
            'from_id'       => 'required',
            'to_id'         => 'required',
            'sell_id'       => 'required_if:type,sell',
            'purchase_id'   => 'required_if:type,purchase',
            'from_select'   => 'required',
            'to_select'     => 'required',
            'status'        => 'required',
            'type'          => 'required',
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
            $data = $data->validate();

            $transaction->user_id       = getuser()->id;
            $transaction->from_user     = (strcmp($data['from_select'],'user')==0) ? $data['from_id'] : null;
            $transaction->from_account  = (strcmp($data['from_select'],'user')==0) ? null : $data['from_id'];
            $transaction->to_user       = (strcmp($data['to_select'],'user')==0) ? $data['to_id'] : null;
            $transaction->to_account    = (strcmp($data['to_select'],'user')==0) ? null : $data['to_id'];
            $transaction->sell_id       = $data['sell_id'];
            $transaction->purchase_id   = $data['purchase_id'];
            $transaction->from_select   = $data['from_select'];
            $transaction->to_select     = $data['to_select'];
            $transaction->status        = $data['status'];
            $transaction->type          = $data['type'];
            $transaction->amount        = $data['amount'];

            $transaction->save();

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => 'Transaction updated successfully',
                'url'       => route('transactions.show',$transaction->id),
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
            $data = $data->validate();

            if(Hash::check($data['password'],getUser()->password)){
                $transaction->status = 'deleted';

                $transaction->save();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Transaction deleted successfully',
                    'url'       => route('transactions.index'),
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
