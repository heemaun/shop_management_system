<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(array_key_exists('search',$request->all())){

            if(strcmp($request->status,'all')==0){
                $status = ['pending','active','deleted','banned','restricted'];
            }
            else{
                $status = [$request->status];
            }

            $categories = Category::where('name','like','%'.$request->search.'%')
                                    ->whereIn('status',$status)
                                    ->where('shop_id',getUser()->shop_id)
                                    ->orderBy('status')
                                    ->orderBy('name')
                                    ->get();

            return response(view('category.search',compact('categories')));
        }
        $categories = Category::where('shop_id',getUser()->shop_id)
                                    ->orderBy('status')
                                    ->orderBy('name')
                                    ->get();
        return response(view('category.index',compact('categories')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('category.create'));
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
            'name'      => 'required|string|min:3|max:30',
            'status'    => 'required'
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

            $category = Category::create([
                'shop_id'   => getUser()->shop_id,
                'user_id'   => getUser()->id,
                'name'      => $data['name'],
                'status'    => $data['status'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Category added successfully',
                'url' => route('categories.show',$category->id),
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response(view('category.show',compact('category')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response(view('category.edit',compact('category')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = Validator::make($request->all(),[
            'name'      => 'required|string|min:3|max:30',
            'status'    => 'required'
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

            $category->user_id = getUser()->id;
            $category->name = $data['name'];
            $category->status = $data['status'];

            $category->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully',
                'url' => route('categories.show',$category->id),
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
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
                $category->delete();

                DB::commit();

                return response()->json([
                    'status'    => 'success',
                    'message'   => 'Category deleted successfully',
                    'url' => route('categories.index'),
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
