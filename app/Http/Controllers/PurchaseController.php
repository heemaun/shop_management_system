<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_name = null, $customer_name = null, $status = null)
    {
        $purchases = Purchase::join('users as u','u.id','=','purchases.user_id')
                                ->join('users as c','c.id','=','purchases.customer_id')
                                ->where('purchases.shop_id',getUser()->shop_id)
                                ->where('u.name' , 'LIKE', '%'.$user_name.'%')
                                ->where('c.name' , 'LIKE', '%'.$customer_name.'%')
                                ->where('status',$status)
                                ->get();
        return response(view('purchase.index',compact('purchases')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('purchase.create'));
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
            'customer_id'           => 'nullable',
            'status'                => 'required',
            'total_price'           => 'required|numeric',
            'total_product_count'   => 'required|numeric',
            'total_order_count'     => 'required|numeric',
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

            Purchase::create([
                'shop_id'               => getUser()->shop_id,
                'user_id'               => getUser()->id,
                'customer_id'           => $data['customer_id'],
                'status'                => $data['status'],
                'total_price'           => $data['total_price'],
                'total_product_count'   => $data['total_product_count'],
                'total_order_count'     => $data['total_order_count'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Purchase added successfully',
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
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return response(view('purchase.show',compact('purchase')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        return response(view('purchase.edit',compact('purchase')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $data = Validator::make($request->all(),[
            'customer_id'           => 'nullable',
            'status'                => 'required',
            'total_price'           => 'required|numeric',
            'total_product_count'   => 'required|numeric',
            'total_order_count'     => 'required|numeric',
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

            $purchase->user_id              = getUser()->id;
            $purchase->customer_id          = $data['customer_id'];
            $purchase->status               = $data['status'];
            $purchase->total_price          = $data['total_price'];
            $purchase->total_product_count  = $data['total_product_count'];
            $purchase->total_order_count    = $data['total_order_count'];

            $purchase->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Purchase updated successfully',
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
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase, Request $request)
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
                $purchase->delete();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Purchase deleted successfully',
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
