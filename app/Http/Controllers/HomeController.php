<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\Country;

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
}
