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
        $response = $this->get('/back/user');

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
}
