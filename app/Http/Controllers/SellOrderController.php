<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\SellOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SellOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_name = null, $status = null)
    {
        $sellOrders = SellOrder::join('users','users.id','=','sell.user_id')
                                        ->where('users.name',$user_name)
                                        ->where('sell.status',$status)
                                        ->where('shop_id',getUser()->shop_id)
                                        ->get();
        return response(view('sell_order.index',compact('sellOrders')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('sellorder.create'));
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
            'sell_id'       => 'required',
            'product_id'    => 'required',
            'status'        => 'required',
            'units'         => 'required|numeric',
            'unit_price'    => 'required|numeric',
            'subtotal'      => 'required|numeric',
            'discount'      => 'required|numeric',
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

            SellOrder::create([
                'shop_id'       => getUser()->shop_id,
                'user_id'       => getUser()->id,
                'sell_id'       => $data['sell_id'],
                'product_id'    => $data['product_id'],
                'status'        => $data['status'],
                'units'         => $data['units'],
                'unit_price'    => $data['unit_price'],
                'subtotal'      => $data['subtotal'],
                'discount'      => $data['discount'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Sell Order added successfully',
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
     * @param  \App\Models\SellOrder  $sellOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SellOrder $sellOrder)
    {
        return response(view('sell_order.show',compact('sellorder')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellOrder  $sellOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SellOrder $sellOrder)
    {
        return response(view('sell_order.edit',compact('sellOrder')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SellOrder  $sellOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SellOrder $sellOrder)
    {
        $data = Validator::make($request->all(),[
            'sell_id'       => 'required',
            'product_id'    => 'required',
            'status'        => 'required',
            'units'         => 'required|numeric',
            'unit_price'    => 'required|numeric',
            'subtotal'      => 'required|numeric',
            'discount'      => 'required|numeric',
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

            $sellOrder->user_id     = getUser()->id;
            $sellOrder->category_id = $data['category_id'];
            $sellOrder->product_id  = $data['product_id'];
            $sellOrder->status      = $data['status'];
            $sellOrder->units       = $data['units'];
            $sellOrder->unit_price  = $data['unit_price'];
            $sellOrder->subtotal    = $data['subtotal'];
            $sellOrder->discount    = $data['discount'];

            $sellOrder->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Sell Order updated successfully',
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
     * @param  \App\Models\SellOrder  $sellOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SellOrder $sellOrder, Request $request)
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
                $sellOrder->delete();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Product deleted successfully',
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
