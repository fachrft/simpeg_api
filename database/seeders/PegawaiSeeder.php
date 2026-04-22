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
        $golongan = Golongan::first();
        $unitKerja = UnitKerja::whereNotNull('parent_id')->first();

        if ($golongan && $unitKerja) {
            Pegawai::create([
                'nip' => '199001012020121001',
                'nama' => 'Budi Santoso, S.Kom',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'alamat' => 'Jl. Kebon Kacang No. 10',
                'jenis_kelamin' => 'L',
                'golongan_id' => $golongan->id,
                'eselon' => '-',
                'jabatan' => 'Pranata Komputer',
                'tempat_tugas' => 'Kantor Pusat',
                'agama' => 'Islam',
                'unit_kerja_id' => $unitKerja->id,
                'no_hp' => '081234567890',
                'npwp' => '12.345.678.9-012.000',
            ]);
        }
    }
}
