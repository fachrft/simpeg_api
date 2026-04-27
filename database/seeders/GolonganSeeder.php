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
            // Golongan I
            ['nama_golongan' => 'I/a', 'keterangan' => 'Juru Muda'],
            ['nama_golongan' => 'I/b', 'keterangan' => 'Juru Muda Tingkat I'],
            ['nama_golongan' => 'I/c', 'keterangan' => 'Juru'],
            ['nama_golongan' => 'I/d', 'keterangan' => 'Juru Tingkat I'],
            
            // Golongan II
            ['nama_golongan' => 'II/a', 'keterangan' => 'Pengatur Muda'],
            ['nama_golongan' => 'II/b', 'keterangan' => 'Pengatur Muda Tingkat I'],
            ['nama_golongan' => 'II/c', 'keterangan' => 'Pengatur'],
            ['nama_golongan' => 'II/d', 'keterangan' => 'Pengatur Tingkat I'],
            
            // Golongan III
            ['nama_golongan' => 'III/a', 'keterangan' => 'Penata Muda'],
            ['nama_golongan' => 'III/b', 'keterangan' => 'Penata Muda Tingkat I'],
            ['nama_golongan' => 'III/c', 'keterangan' => 'Penata'],
            ['nama_golongan' => 'III/d', 'keterangan' => 'Penata Tingkat I'],
            
            // Golongan IV
            ['nama_golongan' => 'IV/a', 'keterangan' => 'Pembina'],
            ['nama_golongan' => 'IV/b', 'keterangan' => 'Pembina Tingkat I'],
            ['nama_golongan' => 'IV/c', 'keterangan' => 'Pembina Utama Muda'],
            ['nama_golongan' => 'IV/d', 'keterangan' => 'Pembina Utama Madya'],
            ['nama_golongan' => 'IV/e', 'keterangan' => 'Pembina Utama'],
        ];

        foreach ($golongans as $golongan) {
            Golongan::updateOrCreate(
                ['nama_golongan' => $golongan['nama_golongan']],
                ['keterangan' => $golongan['keterangan']]
            );
        }
    }
}
