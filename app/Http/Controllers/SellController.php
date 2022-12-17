<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_name = null, $customer_name = null, $status = null)
    {
        $sells = Sell::join('users as u','u.id','=','sells.user_id')
                                ->join('users as c','c.id','=','sells.customer_id')
                                ->where('sells.shop_id',getUser()->shop_id)
                                ->where('u.name' , 'LIKE', '%'.$user_name.'%')
                                ->where('c.name' , 'LIKE', '%'.$customer_name.'%')
                                ->where('status',$status)
                                ->get();
        return response(view('sell.index',compact('sells')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('sell.create'));
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
            'less'                  => 'required|numeric',
            'vat'                   => 'required|numeric',
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

            Sell::create([
                'shop_id'               => getUser()->shop_id,
                'user_id'               => getUser()->id,
                'customer_id'           => $data['customer_id'],
                'status'                => $data['status'],
                'total_price'           => $data['total_price'],
                'total_product_count'   => $data['total_product_count'],
                'total_order_count'     => $data['total_order_count'],
                'less'                  => $data['less'],
                'vat'                   => $data['vat'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Sell added successfully',
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
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        return response(view('sell.show',compact('sell')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        return response(view('sell.edit',compact('sell')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sell $sell)
    {
        $data = Validator::make($request->all(),[
            'customer_id'           => 'nullable',
            'status'                => 'required',
            'total_price'           => 'required|numeric',
            'total_product_count'   => 'required|numeric',
            'total_order_count'     => 'required|numeric',
            'less'                  => 'required|numeric',
            'vat'                   => 'required|numeric',
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

            $sell->user_id              = getUser()->id;
            $sell->customer_id          = $data['customer_id'];
            $sell->status               = $data['status'];
            $sell->total_price          = $data['total_price'];
            $sell->total_product_count  = $data['total_product_count'];
            $sell->total_order_count    = $data['total_order_count'];
            $sell->less                 = $data['less'];
            $sell->vat                  = $data['vat'];

            $sell->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Sell updated successfully',
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
     * @param  \App\Models\Sell  $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell, Request $request)
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
                $sell->delete();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Sell deleted successfully',
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
