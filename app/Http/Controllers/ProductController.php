<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        if(array_key_exists('search',$request->all())){

            if(strcmp($request->status,'all')==0){
                $status = ['pending','active','deleted','banned','restricted'];
            }
            else{
                $status = [$request->status];
            }

            if(strcmp($request->category_id,'all')==0){
                $categories_id = array();

                foreach($categories as $category){
                    array_push($categories_id,$category->id);
                }
            }
            else{
                $categories_id = [$request->category_id];
            }

            $products = Product::where('name','like','%'.$request->search.'%')
                                    ->whereIn('status',$status)
                                    ->whereIn('category_id',$categories_id)
                                    ->where('shop_id',getUser()->shop_id)
                                    ->orderBy('status')
                                    ->orderBy('name')
                                    ->get();

            return response(view('product.search',compact('products','categories')));
        }
        $products = Product::where('shop_id',getUser()->shop_id)
                            ->orderBy('status')
                            ->orderBy('name')
                            ->get();
        return response(view('product.index',compact('products','categories')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return response(view('product.create',compact('categories')));
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
            'picture'           => 'nullable:picture,string|image|mimes:jpeg,jpg,gif,svg,png|max:2048',
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
            $data = $data->validate();

            $product = Product::create([
                'shop_id'               => getUser()->shop_id,
                'user_id'               => getUser()->id,
                'category_id'           => $data['category_id'],
                'name'                  => $data['name'],
                'status'                => $data['status'],
                'initial_inventory'     => $data['initial_inventory'],
                'current_inventory'     => $data['initial_inventory'],
                'purchase_price'        => $data['purchase_price'],
                'avg_purchase_price'    => $data['purchase_price'],
                'selling_price'         => $data['selling_price'],
            ]);

            if(array_key_exists('picture',$data)){
                $imageName = time().'.'.$data['picture']->extension();

                $data['picture']->move(public_path('images'),$imageName);

                $product->picture = $imageName;
                $product->save();
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product added successfully',
                'url' => route('products.show',$product->id)
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
    public function show(Product $product)
    {
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
        $categories = Category::all();
        return response(view('product.edit',compact('product','categories')));
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
            $data = $data->validate();

            $product->user_id               = getUser()->id;
            $product->category_id           = $data['category_id'];
            $product->name                  = $data['name'];
            $product->status                = $data['status'];
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
                'url' => route('products.show',$product->id)
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'    => 'exception',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function changeProductImage(Request $request, Product $product)
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

            // unlink('assets/images/'.$product->picture);
            File::delete(public_path('images/'.$product->picture));

            $imageName = time().'.'.$data['picture']->extension();
            $data['picture']->move(public_path('images'),$imageName);
            $product->picture = $imageName;

            $product->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product picture updated successfully',
                'url' => route('products.show',$product->id)
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
            $data = $data->validate();

            if(Hash::check($data['password'],getUser()->password)){
                $product->delete();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Product deleted successfully',
                    'url' => route('products.index')
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
