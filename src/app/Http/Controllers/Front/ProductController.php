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
        $categories = Category::all();

        return view('front.product.show', compact('product', 'categories'));
    }
}
