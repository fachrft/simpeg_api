<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Level 1: Utama
        $pusat = UnitKerja::create(['nama_unit' => 'Badan Kepegawaian Negara']);
        
        // Level 2: Anak (Sekretariat/Deputi)
        $sekretariat = UnitKerja::create([
            'nama_unit' => 'Sekretariat Utama', 
            'parent_id' => $pusat->id
        ]);
        
        $deputi = UnitKerja::create([
            'nama_unit' => 'Deputi Bidang Sistem Informasi Kepegawaian', 
            'parent_id' => $pusat->id
        ]);
        
        // Level 3: Cucu (Biro/Direktorat)
        $biro = UnitKerja::create([
            'nama_unit' => 'Biro Kepegawaian', 
            'parent_id' => $sekretariat->id
        ]);
        
        $direktorat = UnitKerja::create([
            'nama_unit' => 'Direktorat Infrastruktur Teknologi Informasi', 
            'parent_id' => $deputi->id
        ]);

        // Level 4: Cicit (Bagian/Sub-Direktorat)
        UnitKerja::create([
            'nama_unit' => 'Bagian Mutasi Kepegawaian', 
            'parent_id' => $biro->id
        ]);

        UnitKerja::create([
            'nama_unit' => 'Sub Direktorat Keamanan Informasi', 
            'parent_id' => $direktorat->id
        ]);
    }
}
