<?php

namespace Database\Factories;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->unique()->numerify('##################'),
            'nama' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'golongan_id' => \App\Models\Golongan::factory(),
            'eselon' => $this->faker->randomElement(['I', 'II', 'III', 'IV', null]),
            'jabatan' => $this->faker->jobTitle(),
            'tempat_tugas' => $this->faker->city(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
            'unit_kerja_id' => \App\Models\UnitKerja::factory(),
            'no_hp' => $this->faker->phoneNumber(),
            'npwp' => $this->faker->numerify('###############'),
            'foto' => null,
        ];
    }
}
