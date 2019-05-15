<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseBoatTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_purchase_boat()
    {
        $user = factory(User::class)->create();

        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post('/sale', [
                'boat' => 1,
                'date' => '02/13/2019',
                'status' => 'quoted',
                'price' => '140000',
            ])->assertSuccessful();

    }
}
