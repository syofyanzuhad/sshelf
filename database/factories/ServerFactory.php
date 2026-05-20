<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Server>
 */
class ServerFactory extends Factory
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
            'name' => fake()->domainName(),
            'host' => fake()->ipv4(),
            'port' => 22,
            'username' => 'root',
            'auth_type' => 'password',
            'password' => 'secret',
            'group' => fake()->word(),
            'notes' => fake()->sentence(),
        ];
    }

    public function keyAuth(): static
    {
        return $this->state(fn (array $attributes) => [
            'auth_type' => 'key',
            'password' => null,
            'private_key' => '-----BEGIN OPENSSH PRIVATE KEY-----...',
            'passphrase' => 'passphrase',
        ]);
    }
}
