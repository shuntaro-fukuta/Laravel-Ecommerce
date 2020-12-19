<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Back\Product;
use App\Models\Back\Category;

class HomeController extends Controller
{
    public function top()
    {
        $products = Product::paginate(20);
        $categories = Category::all();

        return view('front.top', compact('products', 'categories'));
    }

    public function index()
    {
        $products = Product::all();

        return view('front.top', compact('products'));
    }
}
