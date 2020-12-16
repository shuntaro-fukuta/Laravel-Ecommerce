<?php

namespace Tests\Feature\front;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Front\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    protected $loggedInUser;

    protected $loginPagePath = '/login';

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loggedInUser = User::factory(1)->create()->first();
        $this->actingAs($this->loggedInUser);
    }

    /**
     * @test
     */
    public function shouldDisplayUserPage()
    {
        $response = $this->get('/users/' . $this->loggedInUser->id);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayUserPageWithoutLogin()
    {
        $this->logout();

        $response = $this->get('/users/' . $this->loggedInUser->id);

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }


    /**
     * @test
     */
    public function shouldDisplayUserEditPage()
    {
        $response = $this->get('/users/' . $this->loggedInUser->id . '/edit');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldNotDisplayUserEditPageWithoutLogin()
    {
        $this->logout();

        $response = $this->get('/users/' . $this->loggedInUser->id . '/edit');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldEditUser()
    {
        $response = $this->put('/users/' . $this->loggedInUser->id, [
            'name' => 'updated',
            'email' => 'updated@example.com',
            'address' => 'updated',
            'phone_number' => '99999999999',
        ]);

        $updatedUser = User::find($this->loggedInUser->id);

        $this->assertEquals($updatedUser->name, 'updated');
        $this->assertEquals($updatedUser->email, 'updated@example.com');
        $this->assertEquals($updatedUser->address, 'updated');
        $this->assertEquals($updatedUser->phone_number, '99999999999');

        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function shouldNotEditUserWithoutLogin()
    {
        $this->logout();

        $response = $this->put('/users/' . $this->loggedInUser->id, [
            'name' => 'updated',
            'email' => 'updated@example.com',
            'address' => 'updated',
            'phone_number' => '99999999999',
        ]);

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    /**
     * @test
     */
    public function shouldNotEditOtherUser()
    {
        $response = $this->put('/users/999', [
            'name' => 'updated',
            'email' => 'updated@example.com',
            'address' => 'updated',
            'phone_number' => '99999999999',
            'password' => 'updated!!!',
        ]);

        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function shouldDisplayWithdrawalConfirmPage()
    {
        $response = $this->get('/users/' . $this->loggedInUser->id . '/withdraw');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDeleteUser()
    {
        $response = $this->delete('/users/' . $this->loggedInUser->id);

        $this->assertCount(0, User::all());

        $response->assertStatus(302)
                 ->assertRedirect('/withdrawal/complete');
    }

    /**
     * @test
     */
    public function shouldNotDisplayWithdrawalCompletePageWhenLoggedIn()
    {
        $response = $this->get('/withdrawal/complete');

        $response->assertStatus(302)
                 ->assertRedirect('/');
    }

    /**
     * @test
     */
    public function shouldNotDisplayWithdrawalConfirmPageWithoutLogin()
    {
        $this->logout();

        $response = $this->get('/users/' . $this->loggedInUser->id . '/withdraw');

        $response->assertStatus(302)
                 ->assertRedirect($this->loginPagePath);
    }

    protected function logout()
    {
        auth()->logout();
    }
}
