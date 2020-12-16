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

    /**
     * @test
     */
    public function shouldDisplayCategoryEditPage()
    {
        $category = Category::factory(1)->create()->first();

        $response = $this->get('/back/categories/' . $category->id . '/edit');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayCategoryEditPageWithoutLogin()
    {
        $this->logout();

        $category = Category::factory(1)->create()->first();
        $response = $this->get('/back/categories/' . $category->id . '/edit');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldUpdateCategoryWithValidParams()
    {
        $category = Category::factory(1)->create()->first();

        $response = $this->put('/back/categories/' . $category->id, [
            'name' => 'updated',
        ]);

        $updatedCategory = Category::find($category->id);
        $this->assertEquals('updated', $updatedCategory->name);

        $response->assertStatus(302)
                 ->assertRedirect('/back/categories/' . $updatedCategory->id);
    }

    /**
     * @test
     */
    public function shouldNotUpdateCategoryWithInvalidParams()
    {
        $category = Category::factory(1)->create()->first();

        $response = $this->put('/back/categories/' . $category->id, [
            'name' => '',
        ]);

        $afterRequestCategory = Category::find($category->id);

        $this->assertNotEquals($category, $afterRequestCategory);

        $response->assertStatus(302);
    }


    protected function logout()
    {
        auth()->logout();
    }
}
