<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Back\Operator;

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

    protected function logout()
    {
        auth()->logout();
    }
}
