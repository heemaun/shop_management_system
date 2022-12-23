<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('system.index');
    }

    public function home()
    {
        $categories = Category::all();
        return view('system.home',compact('categories'));
    }

    public function dashboard(Request $request)
    {
        return response(view('system.dashboard',compact('request')));
    }
}
