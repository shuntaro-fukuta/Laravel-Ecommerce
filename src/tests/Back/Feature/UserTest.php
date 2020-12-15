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
        $response = $this->get('/back/user/menu');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDisplayUserIndexPage()
    {
        $response = $this->get('/back/user/index');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldSearchWithValidKeywords()
    {
        $response = $this->get('/back/user/index', [
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

        $response = $this->get('back/user/' . $user->id);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDisplayUserCreatePage()
    {
        $response = $this->get('/back/user/create');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldCreateWithValidParameters()
    {
        $response = $this->post('/back/user/create', [
            'name' => 'test',
            'email' => 'test@example.com',
            'phone_number' => '08012341234',
            'address' => 'test',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $createdUser = User::all()->last();

        $response->assertStatus(302)
                 ->assertRedirect('/back/user/' . $createdUser->id);
    }

    /**
     * @test
     */
    public function shouldNotCreateUserWithInvalidParameters()
    {
        $response = $this->post('/back/user/create', [
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

        $response = $this->get('/back/user/' . $user->id . '/edit');

        $response->assertStatus(200);
    }

}
