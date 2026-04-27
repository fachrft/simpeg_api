<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\UnitKerja;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongans = Golongan::all();
        $unitKerjas = UnitKerja::all();

        if ($golongans->isEmpty() || $unitKerjas->isEmpty()) {
            $this->command->warn('Golongan or Unit Kerja table is empty. Please seed them first.');
            return;
        }

        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 30; $i++) {
            $gender = $faker->randomElement(['L', 'P']);
            $firstName = $gender == 'L' ? $faker->firstNameMale() : $faker->firstNameFemale();
            $lastName = $faker->lastName();
            $nama = $firstName . ' ' . $lastName;

            Pegawai::create([
                'nip' => $faker->unique()->numerify('##################'),
                'nama' => $nama . $faker->randomElement([', S.Kom', ', M.T.', ', S.E.', ', M.M.', '']),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'alamat' => $faker->address(),
                'jenis_kelamin' => $gender,
                'golongan_id' => $golongans->random()->id,
                'eselon' => $faker->randomElement(['I', 'II', 'III', 'IV', '-']),
                'jabatan' => $faker->jobTitle(),
                'tempat_tugas' => $faker->city(),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'unit_kerja_id' => $unitKerjas->random()->id,
                'no_hp' => $faker->phoneNumber(),
                'npwp' => $faker->numerify('##.###.###.#-###.###'),
            ]);
        }
    }
}
