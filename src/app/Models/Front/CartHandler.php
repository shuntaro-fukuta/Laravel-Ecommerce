<?php

namespace App\Models\Front;

use Illuminate\Support\Collection;

class CartHandler
{
    const SESSION_CART_NAME = 'cart';

    public function add(String $janCode, CartProduct $product)
    {
        $cart = $this->getCart();
        if (!$cart->has($janCode)) {
            $cart->put($janCode, $product);
            $this->saveCartToSession($cart);
            return;
        }

        $currentProduct = $cart->get($janCode);
        $currentProduct->setQuantity($currentProduct->getQuantity() + $product->getQuantity());
        $this->saveCartToSession($cart);
    }

    public function update(String $janCode, CartProduct $product)
    {
        $cart = $this->getCart();
        if ($cart->has($janCode)) {
            $cart->put($janCode, $product);
            $this->saveCartToSession($cart);
        }
    }

    public function remove(String $janCode)
    {
        $cart = $this->getCart();
        if ($cart->has($janCode)) {
            $cart->pull($janCode);
        }

        return $cart;
    }

    public function getContentByJanCode(String $janCode)
    {
        $cart = $this->getCart();
        return $cart->get($janCode);
    }

    public function getTotalAmountIncludingTax()
    {
        $cart = $this->getCart();

        $totalAmount = $cart->reduce(function ($sum, $product) {
            $unitPriceIncludingTax = $product->getUnitPrice() * CartProduct::SALES_TAX_RATE;
            $sum += floor($unitPriceIncludingTax * $product->getQuantity());
            return $sum;
        });

        return $totalAmount;
    }

    public function getContents()
    {
        return session()->has(self::SESSION_CART_NAME)
            ? session()->get(self::SESSION_CART_NAME)
            : new Collection();
    }

    private function getCart()
    {
        return $this->existsCartOnSession()
            ? session()->get(self::SESSION_CART_NAME)
            : new Collection();
    }

    private function existsCartOnSession()
    {
        return session()->has(self::SESSION_CART_NAME);
    }

    private function saveCartToSession(Collection $cart)
    {
        session()->put(self::SESSION_CART_NAME, $cart);
    }
}
