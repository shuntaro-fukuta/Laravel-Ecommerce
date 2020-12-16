<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Back\Operator;
use App\Models\Back\Category;

class CategoryTest extends TestCase
{
    protected $loggedInOperator;

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
    public function shouldDisplayCategoryMenuPage()
    {
        $response = $this->get('/back/categories/menu');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayCategoryMenuPageWithoutLogin()
    {
        $this->logout();
        $response = $this->get('/back/categories/menu');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldDisplayCategoryIndexPage()
    {
        $response = $this->get('/back/categories');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayCategoryIndexPageWithoutLogin()
    {
        $this->logout();
        $response = $this->get('/back/categories');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldDisplayCategoryShowPage()
    {
        $category = Category::factory(1)->create()->first();
        $response = $this->get('/back/categories/' . $category->id);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayCategoryShowPageWithoutLogin()
    {
        $this->logout();

        $category = Category::factory(1)->create()->first();
        $response = $this->get('/back/categories/' . $category->id);

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }


    protected function logout()
    {
        auth()->logout();
    }
}
