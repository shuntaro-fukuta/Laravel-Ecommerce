<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Back\Operator;

class OperatorTest extends TestCase
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
    public function shouldDisplayTopPage()
    {
        $response = $this->get('/back');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDisplayOperatorManagementPage()
    {
        $response = $this->get('/back/operators/menu');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDisplayOperatorIndexPage()
    {
        $response = $this->get('/back/operators');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldSearchWithValidKeywords()
    {
        $response = $this->get('/back/operators', [
            'name' => 'test',
            'email' => 'test',
        ]);

        $response->assertStatus(200);
    }
}
