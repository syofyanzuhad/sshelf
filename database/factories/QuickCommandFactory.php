<?php

namespace Database\Factories;

use App\Models\QuickCommand;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuickCommand>
 */
class QuickCommandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'server_id' => Server::factory(),
            'name' => $this->faker->sentence(3),
            'command' => $this->faker->sentence(10),
        ];
    }
}
