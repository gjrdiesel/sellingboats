<?php

namespace Tests\Feature;

use App\User;
use App\Customer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_must_be_logged_in()
    {
        $this->get(route('customer.index'))
            ->assertRedirect(route('login'));
    }

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
