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
            'name' => 'test',
            'price' => 2000,
            'image_url' => 'https://example.com',
            'description' => 'test',
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


    protected function logout()
    {
        auth()->logout();
    }
}
