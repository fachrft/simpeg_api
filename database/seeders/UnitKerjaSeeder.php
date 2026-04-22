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
        $sekretariat = UnitKerja::create(['nama_unit' => 'Sekretariat Utama']);
        $deputi = UnitKerja::create(['nama_unit' => 'Deputi Bidang SDM']);
        
        UnitKerja::create(['nama_unit' => 'Biro Kepegawaian', 'parent_id' => $sekretariat->id]);
        UnitKerja::create(['nama_unit' => 'Direktorat Pengadaan', 'parent_id' => $deputi->id]);
    }
}
