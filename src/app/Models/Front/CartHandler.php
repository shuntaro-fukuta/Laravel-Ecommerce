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

    public static function update(String $janCode, CartProduct $product)
    {
        $cart = self::getCart();
        if ($cart->has($janCode)) {
            $cart->put($janCode, $product);
            self::saveCartToSession($cart);
        }
    }

    public static function remove(String $janCode)
    {
        $cart = self::getCart();
        if ($cart->has($janCode)) {
            $cart->pull($janCode);
        }

        return $cart;
    }

    public static function incrementQuantity(String $janCode, int $quantity)
    {
        $cart = self::getCart();
        if ($cart->has($janCode)) {
            $product = $cart->get($janCode);

            $quantity += 1;
            $product->setQuantity($quantity);

            self::update($janCode, $product);

            return $quantity;
        }
    }

    public static function decrementQuantity(String $janCode, int $quantity)
    {
        $cart = self::getCart();
        if ($cart->has($janCode)) {
            $product = $cart->get($janCode);

            $quantity -= 1;
            $product->setQuantity($quantity);

            self::update($janCode, $product);

            return $quantity;
        }
    }

    public static function getContentByJanCode(String $janCode)
    {
        $cart = self::getCart();
        return $cart->get($janCode);
    }

    public static function getTotalAmountIncludingTax()
    {
        $cart = self::getCart();

        $totalAmount = $cart->reduce(function ($sum, $product) {
            $unitPriceIncludingTax = $product->getUnitPrice() * CartProduct::SALES_TAX_RATE;
            $sum += floor($unitPriceIncludingTax * $product->getQuantity());
            return $sum;
        });

        return $totalAmount;
    }

    public static function getContents()
    {
        return session()->has(self::SESSION_CART_NAME)
            ? session()->get(self::SESSION_CART_NAME)
            : new Collection();
    }

    private static function getCart()
    {
        return self::existsCartOnSession()
            ? session()->get(self::SESSION_CART_NAME)
            : new Collection();
    }

    private static function existsCartOnSession()
    {
        return session()->has(self::SESSION_CART_NAME);
    }

    private static function saveCartToSession(Collection $cart)
    {
        session()->put(self::SESSION_CART_NAME, $cart);
    }
}
