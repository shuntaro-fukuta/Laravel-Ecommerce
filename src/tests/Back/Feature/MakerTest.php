<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Back\Maker;
use App\Models\Back\Operator;

class MakerTest extends TestCase
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
    public function shouldDisplayMakerIndexPage()
    {
        $response = $this->get('/back/makers/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDisplayMakerShowPage()
    {
        $maker = Maker::factory(1)->create()->first();
        $response = $this->get('/back/makers/' . $maker->id);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldDisplayMakerCreatePage()
    {
        $response = $this->get('/back/makers/create');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function shouldCreateMakerWithValidParams()
    {
        $this->assertCount(0, Maker::all());

        $response = $this->post('/back/makers/', [
            'name' => 'test',
            'email' => 'test@example.com',
            'phone_number' => '08012341234',
            'address' => 'test',
        ]);

        $this->assertCount(1, Maker::all());

        $createdMaker = Maker::all()->last();

        $response->assertStatus(302)
                 ->assertRedirect('/back/makers/' . $createdMaker->id);
    }

    /**
     * @test
     */
    public function shouldNotCreateMakerWithInvalidParams()
    {
        $this->assertCount(0, Maker::all());

        $response = $this->post('/back/makers/', [
            'name' => '',
            'email' => 'test',
            'phone_number' => 'test',
            'address' => str_repeat('a', 201),
        ]);

        $this->assertCount(0, Maker::all());

        $response->assertStatus(302);
    }

}
