<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'manager',
            'phone' => '09121111111',
            'is_manager' => true
        ]);

        User::factory()->create([
            'name' => 'user',
            'phone' => '09122222222',
            'is_manager' => false
        ]);

        user::factory(10)->create();
    }
}
