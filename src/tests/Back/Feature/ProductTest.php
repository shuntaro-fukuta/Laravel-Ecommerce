<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Back\Operator;
use App\Models\Back\Product;
use App\Models\Back\Category;
use App\Models\Back\Maker;

class ProductTest extends TestCase
{
    protected $loginPagePath = '/back/login';

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loggedInOperator = Operator::factory(1)->create()->first();
        $this->actingAs($this->loggedInOperator, 'operator');
    }

    /**
     * @test
     */
    public function shouldDisplayMenuPage()
    {
        $response = $this->get('/back/products/menu');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayMenuPageWithoutLogin()
    {
        $this->logout();

        $response = $this->get('/back/products/menu');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldDisplayProductIndexPage()
    {
        $response = $this->get('/back/products');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayProductIndexPageWithoutLogin()
    {
        $this->logout();

        $response = $this->get('/back/products');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldDisplayProductCreatePage()
    {
        $response = $this->get('/back/products/create');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayProductCreatePageWithoutLogin()
    {
        $this->logout();

        $response = $this->get('/back/products/create');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldStoreProductWithValidParams()
    {
        $this->assertCount(0, Product::all());

        $category = Category::factory(1)->create()->first();
        $maker = Maker::factory(1)->create()->first();
        $response = $this->post('/back/products', [
            'category_id' => $category->id,
            'maker_id' => $maker->id,
            'name' => 'valid',
            'price' => 1000,
            'image_url' => 'https://valid.example.com',
            'description' => 'valid',
            'is_published' => true,
        ]);

        $this->assertCount(1, Product::all());

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function shouldNotStoreProductWithInvalidParams()
    {
        $this->assertCount(0, Product::all());

        $response = $this->post('/back/products', [
            'category_id' => 0,
            'maker_id' => 0,
            'name' => '',
            'price' => -1,
            'image_url' => 'hoge',
            'description' => '',
            'is_published' => 'hoge',
        ]);

        $this->assertCount(0, Product::all());

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function shouldDisplayProductEditPage()
    {
        $product = Product::factory(1)->create()->first();
        $response = $this->get('/back/products/' . $product->id . '/edit');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayProductEditPageWithoutLogin()
    {
        $this->logout();

        $product = Product::factory(1)->create()->first();
        $response = $this->get('/back/products/' . $product->id . '/edit');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldUpdateProductWithValidParams()
    {
        $category = Category::factory(1)->create()->first();
        $maker = Maker::factory(1)->create()->first();
        $beforeRequestProduct = Product::create([
            'jan_code' => '1234567890123',
            'category_id' => $category->id,
            'maker_id' => $maker->id,
            'name' => 'before',
            'price' => 1000,
            'image_url' => 'https://before.example.com',
            'description' => 'before',
            'is_published' => false,
        ]);

        $response = $this->put('/back/products/' . $beforeRequestProduct->id, [
            'category_id' => $category->id,
            'maker_id' => $maker->id,
            'name' => 'updated',
            'price' => 0,
            'image_url' => 'https://updated.example.com',
            'description' => 'updated',
            'is_published' => true,
        ]);

        $updatedProduct = Product::find($beforeRequestProduct->id);
        $this->assertEquals('updated', $updatedProduct->name);
        $this->assertEquals(0, $updatedProduct->price);
        $this->assertEquals('https://updated.example.com', $updatedProduct->image_url);
        $this->assertEquals('updated', $updatedProduct->description);
        $this->assertEquals(true, $updatedProduct->is_published);

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function shouldNotUpdateProductWithInvalidParams()
    {
        $category = Category::factory(1)->create()->first();
        $maker = Maker::factory(1)->create()->first();
        $product = Product::create([
            'jan_code' => '0123456890123',
            'category_id' => $category->id,
            'maker_id' => $maker->id,
            'name' => 'before',
            'price' => 1000,
            'image_url' => 'https://before.example.com',
            'description' => 'before',
            'is_published' => true,
        ]);

        $response = $this->put('/back/products/' . $product->id, [
            'category_id' => 0,
            'maker_id' => 0,
            'name' => '',
            'price' => -1,
            'image_url' => 'hoge',
            'description' => '',
            'is_published' => 'hoge',
        ]);

        $this->assertEquals('before', $product->name);
        $this->assertEquals(1000, $product->price);
        $this->assertEquals('https://before.example.com', $product->image_url);
        $this->assertEquals('before', $product->description);

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function shouldDeleteProduct()
    {
        $product = Product::factory(1)->create()->first();

        $response = $this->delete('/back/products/' . $product->id);
        $this->assertNull(Product::find($product->id));

        $response->assertStatus(302)
                 ->assertRedirect('/back/products');
    }
    /**
     * @test
     */
    public function shouldNotDeleteProductWithoutLogin()
    {
        $product = Product::factory(1)->create()->first();
        $this->logout();

        $response = $this->delete('/back/products/' . $product->id);
        $this->assertNotNull(Product::find($product->id));

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    protected function logout()
    {
        auth()->logout();
    }
}
