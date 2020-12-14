<?php

namespace Tests\Feature\Back;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Back\Operator;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function shouldDisplayLoginPage()
    {
        $response = $this->get('/back/login');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldLoginWithExistingOperator()
    {
        $operator = Operator::factory(1)->create()->first();

        $response = $this->post('/back/login', [
            'name' => $operator->name,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/back');

        $this->assertAuthenticatedAs($operator, 'operator');
    }
}
