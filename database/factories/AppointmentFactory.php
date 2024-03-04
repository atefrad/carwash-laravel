<?php

namespace Database\Factories;

use App\Models\Time;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $time = Time::query()->inRandomOrder()->first();
        $time->update(['is_active' => 0]);

        return [
            'time_id' => $time,
            'phone' => fake()->phoneNumber,
            'name' => fake()->name,
            'tracking_code' => rand(100000, 999999)
        ];
    }
}
