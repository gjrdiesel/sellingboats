<?php

namespace Tests\Feature;

use App\Customer;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_save_customer()
    {
        $user = factory(User::class)->create();

        $customer = factory(Customer::class)->make();

        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post('/customer', [
                'first_name' => $customer->first_name,
                'last_name' => $customer->last_name,
                'address' => $customer->address,
                'email' => $customer->email,
                'phone' => $customer->phone,
            ])->assertSuccessful();
    }
}
