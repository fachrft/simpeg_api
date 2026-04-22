<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongans = [
            ['nama_golongan' => 'III/a', 'keterangan' => 'Penata Muda'],
            ['nama_golongan' => 'III/b', 'keterangan' => 'Penata Muda Tingkat I'],
            ['nama_golongan' => 'III/c', 'keterangan' => 'Penata'],
            ['nama_golongan' => 'III/d', 'keterangan' => 'Penata Tingkat I'],
            ['nama_golongan' => 'IV/a', 'keterangan' => 'Pembina'],
            ['nama_golongan' => 'IV/b', 'keterangan' => 'Pembina Tingkat I'],
        ];

        foreach ($golongans as $golongan) {
            Golongan::create($golongan);
        }
    }
}
