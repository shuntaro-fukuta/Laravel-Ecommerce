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
        $response = $this->get('/user/' . $this->loggedInUser->id);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDisplayUserEditPage()
    {
        $response = $this->get('/user/' . $this->loggedInUser->id . '/edit');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldEditUser()
    {
        $response = $this->post('/user/' . $this->loggedInUser->id . '/edit', [
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
    public function shouldNotEditOtherUser()
    {
        $response = $this->post('/user/999/edit', [
            'name' => 'updated',
            'email' => 'updated@example.com',
            'address' => 'updated',
            'phone_number' => '99999999999',
            'password' => 'updated!!!',
        ]);

        $response->assertStatus(404);
    }
}
