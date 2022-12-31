<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Settings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(array_key_exists('search',$request->all())){
            $settings = Settings::where('key','LIKE','%'.$request->search.'%')
                                    ->where('shop_id',getUser()->shop_id)
                                    ->orderBy('key')
                                    ->get();

            return response(view('settings.search',compact('settings')));
        }
        $settings = Settings::where('shop_id',getUser()->shop_id)
                                    ->orderBy('key')
                                    ->get();
        return response(view('settings.index',compact('settings')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        return response(view('settings.show',compact('settings')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        return response(view('settings.edit',compact('settings')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        if(Str::contains($settings->key,['Image','image','Picture','picture','Photo','photo'])){
            $data = Validator::make($request->all(),[
                'picture' => 'nullable:picture,string|image|mimes:jpeg,jpg,gif,svg,png|max:5120',
            ]);

            try{
                $data = $data->validate();

                File::delete(public_path('images/'.$settings->value));

                $imageName = time().'.'.$data['picture']->extension();
                $data['picture']->move(public_path('images'),$imageName);
                $settings->value = $imageName;

                $settings->save();

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Settings image saved successfully',
                    'url' => route('settings.index'),
                ]);
            }catch(Exception $e){
                DB::rollBack();
                return response()->json([
                    'status'    => 'exception',
                    'message'   => $e->getMessage(),
                ]);
            }
        }

        $data = Validator::make($request->all(),[
            'value' => 'required',
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

            $settings->user_id = getUser()->id;
            $settings->value = $data['value'];

            $settings->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Settings saved successfully',
                'url' => route('settings.index'),
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
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
}
