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
        $products = CartHandler::getContents();
        $categories = Category::all();
        return view('front.cart.index', compact('products', 'categories'));
    }

    public function incrementQuantity(Request $request, String $janCode)
    {
        $quantity = CartHandler::incrementQuantity($janCode, $request->input('quantity'));

        return ['quantity' => $quantity];
    }

    public function decrementQuantity(Request $request, String $janCode)
    {
        $quantity = CartHandler::decrementQuantity($janCode, $request->input('quantity'));

        return ['quantity' => $quantity];
    }
}
