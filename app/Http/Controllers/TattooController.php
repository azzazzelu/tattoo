<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class TattooController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brands::all();
        return view('home.home', compact('categories','brands'));
    }
}
