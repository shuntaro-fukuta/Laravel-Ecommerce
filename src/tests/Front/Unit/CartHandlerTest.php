<?php

namespace Tests\Front\Unit;

use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Front\CartHandler;
use App\Models\Front\CartProduct;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

class CartHandlerTest extends TestCase
{
    protected CartHandler $cartHandler;

    public function setUp(): void
    {
        parent::setUp();
        $this->cartHandler = new CartHandler();
    }

    public function testAdd()
    {
        $janCode = '1234567890123';
        $this->cartHandler->add($janCode, new CartProduct('test', 1, 3000, 'hoge'));

        $product = $this->cartHandler->getContentByJanCode($janCode);
        assertEquals('test', $product->getName());
        assertEquals(1, $product->getQuantity());
        assertEquals(3000, $product->getUnitPrice());
    }

    public function testRemove()
    {
        $janCode = '1234567890123';
        $this->cartHandler->add($janCode, new CartProduct('test', 1, 3000, 'hoge'));

        $product = $this->cartHandler->getContentByJanCode($janCode);
        assertNotNull($product);

        $this->cartHandler->remove($janCode);
        $product = $this->cartHandler->getContentByJanCode($janCode);
        assertNull($product);
    }

    public function testUpdate()
    {
        $janCode = '1234567890123';
        $this->cartHandler->add($janCode, new CartProduct('test', 1, 3000, 'hoge'));

        $this->cartHandler->update($janCode, new CartProduct('updated', 2, 5000, 'hoge'));

        $product = $this->cartHandler->getContentByJanCode($janCode);
        assertEquals('updated', $product->getName());
        assertEquals(2, $product->getQuantity());
        assertEquals(5000, $product->getUnitPrice());
    }

    public function testGetTotalAmountIncludingTax()
    {
        $this->cartHandler->add('1234567890123', new CartProduct('item1', 1, 100, 'hoge'));
        $this->cartHandler->add('2345678901234', new CartProduct('item2', 2, 100, 'hoge'));

        $actual = $this->cartHandler->getTotalAmountIncludingTax();
        assertEquals(330, $actual);
    }

    public function testGetContents()
    {
        $beforeContents = $this->cartHandler->getContents();
        assertEquals(new Collection(), $beforeContents);

        $janCode1 = '1234567890123';
        $this->cartHandler->add($janCode1, new CartProduct('item1', 1, 100, 'hoge'));
        $janCode2 = '2345678901234';
        $this->cartHandler->add($janCode2, new CartProduct('item2', 2, 100, 'hoge'));

        $afterContents = $this->cartHandler->getContents();
        $item1 = $afterContents->get($janCode1);
        assertEquals('item1', $item1->getName());
        assertEquals(1, $item1->getQuantity());
        assertEquals(100, $item1->getUnitPrice());
        assertEquals('hoge', $item1->getImageUrl());

        $item2 = $afterContents->get($janCode2);
        assertEquals('item2', $item2->getName());
        assertEquals(2, $item2->getQuantity());
        assertEquals(100, $item2->getUnitPrice());
        assertEquals('hoge', $item2->getImageUrl());
    }
}
