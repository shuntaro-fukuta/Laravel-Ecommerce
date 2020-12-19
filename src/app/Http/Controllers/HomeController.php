<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Back\Product;

class HomeController extends Controller
{
    public function top()
    {
        $products = Product::paginate(20);

        return view('front.top', compact('products'));
    }

    public function index()
    {
        $products = Product::all();

        return view('front.top', compact('products'));
    }
}
