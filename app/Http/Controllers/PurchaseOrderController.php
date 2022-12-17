<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_name = null, $status = null)
    {
        $purchaseOrders = PurchaseOrder::join('users','users.id','=','purchase.user_id')
                                        ->where('users.name',$user_name)
                                        ->where('purchase.status',$status)
                                        ->where('shop_id',getUser()->shop_id)
                                        ->get();
        return response(view('purchase_order.index',compact('purchaseOrders')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('purchaseorder.create'));
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
            'purchase_id'   => 'required',
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

            PurchaseOrder::create([
                'shop_id'       => getUser()->shop_id,
                'user_id'       => getUser()->id,
                'purchase_id'   => $data['purchase_id'],
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
                'message' => 'Purchase Order added successfully',
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
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        return response(view('purchase_order.show',compact('purchaseorder')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        return response(view('purchase_order.edit',compact('purchaseOrder')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $data = Validator::make($request->all(),[
            'purchase_id'   => 'required',
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

            $purchaseOrder->user_id     = getUser()->id;
            $purchaseOrder->category_id = $data['category_id'];
            $purchaseOrder->product_id  = $data['product_id'];
            $purchaseOrder->status      = $data['status'];
            $purchaseOrder->units       = $data['units'];
            $purchaseOrder->unit_price  = $data['unit_price'];
            $purchaseOrder->subtotal    = $data['subtotal'];
            $purchaseOrder->discount    = $data['discount'];

            $purchaseOrder->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Purchase Order updated successfully',
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
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder, Request $request)
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
                $purchaseOrder->delete();

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
