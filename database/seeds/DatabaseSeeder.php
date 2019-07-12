<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'email'    => 'admin@example.com',
            'name'     => 'Jani Gyllenberg',
            'password' => bcrypt('password'),
        ]);

        factory(\App\Customer::class)->create([
            'email'      => 'jani@marineconnection.com',
            'first_name' => 'Jani',
            'last_name'  => 'Gyllenberg',
        ]);

        factory(\App\Boat::class)->times(5)->create();
        factory(\App\Customer::class)->times(100)->create();

        $customers = \App\Customer::all();
        factory(\App\Sale::class)->times(100)->create()->each(function ($sale) use ($customers) {
            $sale->customers()->sync(
                $customers->random(rand(1, 3))
            );
        });
    }
}
