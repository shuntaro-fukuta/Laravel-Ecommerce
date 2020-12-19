<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Back\Product;
use App\Models\Back\Category;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $products = Product::with(['maker', 'category'])->get();

        $categories = Category::all();

        return view('front.product.show', compact('product', 'categories'));
    }
}
