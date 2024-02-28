<?php

namespace Database\Factories;

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
        $start_time = now()->addHours(rand(0,1500));
        $finish_time = $start_time->copy()->addMinutes(30);

        return [
            'service_id' => rand(1, 3),
            'phone' => fake()->phoneNumber,
            'name' => fake()->name,
            'start_time' => $start_time,
            'finish_time' => $finish_time,
            'station' => rand(1,2),
            'tracking_code' => rand(100000, 999999)
        ];
    }
}
