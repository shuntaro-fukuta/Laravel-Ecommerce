<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Back\Operator;

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

    protected function logout()
    {
        auth()->logout();
    }
}
