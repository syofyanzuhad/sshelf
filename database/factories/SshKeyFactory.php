<?php

namespace Database\Factories;

use App\Models\SshKey;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SshKey>
 */
class SshKeyFactory extends Factory
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
            'name' => $this->faker->word().' Key',
            'public_key' => 'ssh-rsa AAAAB3NzaC1yc2E...',
            'private_key' => '-----BEGIN RSA PRIVATE KEY-----...',
            'passphrase' => null,
        ];
    }
}
