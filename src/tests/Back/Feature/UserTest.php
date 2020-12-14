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
    public function shouldDisplayUserEditPage()
    {
        $user = User::factory(1)->create()->first();

        $response = $this->get('/back/user/' . $user->id . '/edit');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldUpdateUser()
    {
        $user = User::factory(1)->create()->first();
        $response = $this->post('/back/user/' . $user->id . '/edit', [
            'name' => 'updated',
            'email' => 'updated@example.com',
            'address' => 'updated',
            'phone_number' => '99999999999',
        ]);

        $updatedUser = User::find($user->id);

        $this->assertEquals($updatedUser->name, 'updated');
        $this->assertEquals($updatedUser->email, 'updated@example.com');
        $this->assertEquals($updatedUser->address, 'updated');
        $this->assertEquals($updatedUser->phone_number, '99999999999');

        $response->assertStatus(302);
    }

}
