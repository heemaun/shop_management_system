<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id=null, $name=null, $status=null)
    {
        $products = Product::where('category_id',$category_id)
                            ->where('name',$name)
                            ->where('status',$status)
                            ->where('shop_id',getUser()->shop_id)
                            ->get();
        return response(view('product.index',compact('products')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('product.create'));
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
            'category_id'       => 'required',
            'name'              => 'required|string|min:3|max:20',
            'status'            => 'required|string',
            'picture'           => 'nullable|string',
            'initial_inventory' => 'required|numeric',
            'purchase_price'    => 'required|numeric',
            'selling_price'     => 'required|numeric',
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

            Product::create([
                'shop_id'               => getUser()->shop_id,
                'user_id'               => getUser()->id,
                'category_id'           => $data['category_id'],
                'name'                  => $data['name'],
                'status'                => $data['status'],
                'picture'               => $data['picture'],
                'initial_inventory'     => $data['initial_inventory'],
                'current_inventory'     => $data['current_inventory'],
                'purchase_price'        => $data['purchase_price'],
                'avg_purchase_price'    => $data['avg_purchase_price'],
                'selling_price'         => $data['selling_price'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product added successfully',
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Request $request)
    {
        if($request->dataType !== null){
            return response()->json([
                'product' => $product,
            ]);
        }
        return response(view('product.show',compact('product')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return response(view('product.edit',compact('product')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = Validator::make($request->all(),[
            'category_id'           => 'required',
            'name'                  => 'required|string|min:3|max:20',
            'status'                => 'required|string',
            'picture'               => 'nullable|string',
            'initial_inventory'     => 'required|numeric',
            'current_inventory'     => 'required|numeric',
            'purchase_price'        => 'required|numeric',
            'avg_purchase_price'    => 'required|numeric',
            'selling_price'         => 'required|numeric',
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

            $product->user_id               = getUser()->id;
            $product->category_id           = $data['category_id'];
            $product->name                  = $data['name'];
            $product->status                = $data['status'];
            $product->picture               = $data['picture'];
            $product->initial_inventory     = $data['initial_inventory'];
            $product->current_inventory     = $data['current_inventory'];
            $product->purchase_price        = $data['purchase_price'];
            $product->avg_purchase_price    = $data['avg_purchase_price'];
            $product->selling_price         = $data['selling_price'];

            $product->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully',
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
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
                $product->delete();

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
