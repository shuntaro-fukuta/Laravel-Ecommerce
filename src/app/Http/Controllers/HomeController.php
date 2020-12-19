<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Back\Product;
use App\Models\Back\Category;

class HomeController extends Controller
{
    public function top(Request $request)
    {
        $searched_category_id = $request->input('category_id');

        $query = Product::query();
        if (!is_null($searched_category_id)) $query->where('category_id', $searched_category_id);
        $products = $query->paginate(20);

        $categories = Category::all();

        return view('front.top', compact('products', 'categories', 'searched_category_id'));
    }

    public function index()
    {
        $products = Product::all();

        return view('front.top', compact('products'));
    }
}
