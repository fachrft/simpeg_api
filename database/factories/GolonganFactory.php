<?php

namespace Database\Factories;

use App\Models\Golongan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Golongan>
 */
class GolonganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_golongan' => $this->faker->unique()->randomElement(['I/a', 'I/b', 'II/a', 'II/b', 'III/a', 'III/b', 'IV/a', 'IV/b']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
