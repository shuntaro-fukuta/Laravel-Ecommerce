<?php

namespace Tests\Back\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Back\Maker;

class MakerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldDisplayMakerIndexPage()
    {
        $response = $this->get('/back/makers/');

        $response->assertStatus(200);
    }
}
