<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Front\CartHandler;
use App\Models\Front\CartProduct;
use App\Models\Back\Category;
use App\Models\Back\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $janCode = $request->input('jan_code');
        $product = Product::where('jan_code', $janCode)->first();

        $cartHandler = new CartHandler();
        $product = new CartProduct(
            $product->name,
            $request->input('quantity'),
            $product->price,
            $product->image_url,
        );

        $cartHandler->add($janCode, $product);

        return redirect(route('cart.show'));
    }

    public function show()
    {
        $products = CartHandler::getContents();
        $categories = Category::all();
        return view('front.cart.index', compact('products', 'categories'));
    }

    public function delete(String $janCode)
    {
        CartHandler::remove($janCode);

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
