<?php

namespace Tests\Feature\Front;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function shouldDisplayRegisterPage()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldRegisterWithValidParams()
    {
        $this->assertCount(0, User::all());

        $response = $this->post('/register', [
            'name' => 'taro',
            'email' => 'taro@example.com',
            'address' => '北海道札幌市',
            'phone_number' => '08012341234',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertCount(1, User::all());

        $response
            ->assertStatus(302)
            ->assertRedirect('/top');
    }

    /**
     * @test
     */
    public function shouldDisplayLoginPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldLoginWithExistingUser()
    {
        $user = User::factory(1)->create()->first();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/top');

        $this->assertAuthenticatedAs($user);
    }
}
