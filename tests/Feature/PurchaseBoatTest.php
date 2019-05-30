<?php

namespace Tests\Feature;

use App\Sale;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseBoatTest extends TestCase
{
    use RefreshDatabase;

    public function test_must_be_logged_in()
    {
        $this->get(route('sale.create'))
            ->assertRedirect(route('login'));
    }

    public function test_can_purchase_boat()
    {
        $boat = factory(\App\Boat::class)->create();
        $user = factory(User::class)->create();
        $customers = factory(\App\Customer::class)->times(2)->create();
        $ids = $customers->pluck('id')->toArray();

        $this
            ->actingAs($user)
            ->post(route('sale.store'), [
                'boat_id' => $boat->id,
                'sold_at' => '2017-06-1T14:00',
                'status' => 'quoted',
                'price' => 999999999.99,
                'customers' => $ids
            ])->assertSessionHasNoErrors()
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('sales', ['price' => 999999999.99]);
        $this->assertDatabaseHas('customer_sale', ['customer_id' => $ids[0]]);
    }

    public function test_fails_validation()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post(route('sale.store'), [
                'boat_id' => 9,
                'sold_at' => '03/13/',
                'status' => 'lost',
                'price' => 1000000001,
                'customers' => [1337, 1337]
            ])->assertSessionHasErrors(['boat_id', 'sold_at', 'status', 'price', 'customers.0', 'customers.1']);
    }

    public function test_can_edit_purchase_agreement()
    {
        $user = factory(User::class)->create();
        $customers = factory(\App\Customer::class)->times(2)->create();
        $ids = $customers->pluck('id')->toArray();

        $sale = factory(Sale::class)->create(['price' => .99]);
        $sale->customers()->sync($ids);
        $sale->customers = $ids;

        $sale->price = 999919999.99;
        $sale = $sale->toArray();

        $this
            ->actingAs($user)
            ->get(route('sale.edit', $sale['id']))
            ->assertSee(':old="0.99"');

        $this
            ->patch(route('sale.update', $sale['id']), $sale)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('sale.show', $sale['id']));

        $this->assertDatabaseHas('sales', ['price' => 999919999.99]);

        $this
            ->actingAs($user)
            ->get(route('sale.show', $sale['id']))
            ->assertSee('Selling Price of Boat: $999919999.99')
            ->assertSee(implode(', ', $customers->pluck('name')->toArray()));
    }
}
