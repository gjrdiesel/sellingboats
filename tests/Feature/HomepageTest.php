<?php

namespace Tests\Feature;

use App\Sale;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // Homepage requires login now

        $response = $this->get('/');

        $response->assertStatus(302);
    }

    /**
     * Make sure home page renders
     *
     * @return void
     */
    public function test_gets_homepage()
    {
        // Homepage requires login now
        $user = factory(User::class)->create();

        $sales = factory(Sale::class)->times(20)->create();

        $this->actingAs($user)
            ->get('/')
            ->assertSee($sales->first()->boat->yearMakeModel)
            ->assertStatus(200);
    }

    /**
     * Ensure search works
     *
     * @return void
     */
    public function test_homepage_search()
    {
        // Homepage requires login now
        $user = factory(User::class)->create();

        $sales = factory(Sale::class)->times(20)->create();

        $make = $sales->first()->boat->make;

        $this->actingAs($user)
            ->get("/home?search=$make")
            ->assertSee("sale/{$sales->first()->id}")
            ->assertStatus(200);
    }
}
