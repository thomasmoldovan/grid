<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Thomas@136'),
        ]);

        $this->call([
            // CategorySeeder::class,
            LocationSeeder::class,
            StoreSeeder::class,
        ]);
    }
}
