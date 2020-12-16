<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Front\User;
use App\Models\Back\Operator;

class UserTest extends TestCase
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
    public function shouldDisplayUserMenuPage()
    {
        $response = $this->get('/back/users/menu');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayUserMenuPageWithoutLogIn()
    {
        $this->logout();

        $response = $this->get('/back/users/menu');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldDisplayUserIndexPage()
    {
        $response = $this->get('/back/users');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayUserIndexPageWithoutLogIn()
    {
        $this->logout();

        $response = $this->get('/back/users');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }


    /**
     * @test
     */
    public function shouldSearchWithValidKeywords()
    {
        $response = $this->get('/back/users', [
            'name' => 'test',
            'email' => 'test',
            'phone_number' => 'test',
            'address' => 'test',
        ]);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDisplayUserShowPage()
    {
        $user = User::factory(1)->create()->first();

        $response = $this->get('back/users/' . $user->id);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayUserShowPageWithoutLogIn()
    {
        $this->logout();

        $user = User::factory(1)->create()->first();
        $response = $this->get('/back/users/' . $user->id);

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldDisplayUserCreatePage()
    {
        $response = $this->get('/back/users/create');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayUserCreatePageWithoutLogIn()
    {
        $this->logout();

        $response = $this->get('/back/users/create');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldCreateWithValidParameters()
    {
        $response = $this->post('/back/users', [
            'name' => 'test',
            'email' => 'test@example.com',
            'phone_number' => '08012341234',
            'address' => 'test',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $createdUser = User::all()->last();

        $response->assertStatus(302)
                 ->assertRedirect('/back/users/' . $createdUser->id);
    }

    /**
     * @test
     */
    public function shouldNotCreateUserWithoutLogin()
    {
        $this->logout();

        $response = $this->post('/back/users', [
            'name' => 'test',
            'email' => 'test@example.com',
            'phone_number' => '08012341234',
            'address' => 'test',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldNotCreateUserWithInvalidParameters()
    {
        $response = $this->post('/back/users', [
            'name' => str_repeat('a', 31),
            'email' => 'test',
            'phone_number' => 'test',
            'address' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function shouldDisplayUserEditPage()
    {
        $user = User::factory(1)->create()->first();

        $response = $this->get('/back/users/' . $user->id . '/edit');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayUserEditPageWithoutLogin()
    {
        $this->logout();

        $user = User::factory(1)->create()->first();
        $response = $this->get('/back/users/' . $user->id . '/edit');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldDeleteUser()
    {
        $user = User::factory(1)->create()->first();

        $response = $this->delete('/back/users/' . $user->id);

        $response->assertStatus(302)
                 ->assertRedirect('/back/users');
    }

    /**
     * @test
     */
    public function shouldNotDeleteUserWithoutLogin()
    {
        $this->logout();

        $user = User::factory(1)->create()->first();
        $response = $this->delete('/back/users/' . $user->id);

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    protected function logout()
    {
        auth()->logout();
    }
}
