<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Front\CartHandler;
use App\Models\Front\CartProduct;
use App\Models\Back\Category;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cartHandler = new CartHandler();
        $product = new CartProduct(
            $request->input('name'),
            $request->input('quantity'),
            $request->input('price'),
            $request->input('image_url'),
        );

        $cartHandler->add($request->input('janCode'), $product);

        return redirect(route('cart.show'));
    }

    public function show()
    {
        $cartHandler = new CartHandler();
        $categories = Category::all();
        return view('front.cart.index', compact('cartHandler', 'categories'));
    }
}
