<?php

namespace App\Models\Front;

class CartProduct
{
    const SALES_TAX_RATE = 1.1;

    private $name;
    private $quantity;
    private $unitPrice;
    private $imageUrl;

    public function __construct(string $name, int $quantity, int $unitPrice, String $imageUrl)
    {
        $this->name = $name;
        $this->setQuantity($quantity);
        $this->setUnitPrice($unitPrice);
        $this->imageUrl = $imageUrl;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setQuantity(int $quantity)
    {
        // TODO: 値チェック
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setUnitPrice(int $unitPrice)
    {
        // TODO: 値チェック
        $this->unitPrice = $unitPrice;
    }

    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }
}
