<?php

namespace Tests\Feature;

use App\Models\Golongan;
use App\Models\Pegawai;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SimpegApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Buat user untuk autentikasi
        $this->user = User::factory()->create();
    }

       public function test_it_can_get_list_of_pegawai()
    {
        Pegawai::factory()->count(5)->create();

        $response = $this->actingAs($this->user)
            ->getJson('/api/pegawai');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'data',
                    'current_page',
                    'total'
                ]
            ]);
    }

    public function test_it_can_create_pegawai_with_photo()
    {
        Storage::fake('public');
        
        $golongan = Golongan::factory()->create();
        $unitKerja = UnitKerja::factory()->create();

        $data = [
            'nip' => '123456789012345678',
            'nama' => 'Budi Utomo',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Merdeka No. 1',
            'jenis_kelamin' => 'L',
            'golongan_id' => $golongan->id,
            'jabatan' => 'Staff IT',
            'tempat_tugas' => 'Kantor Pusat',
            'agama' => 'Islam',
            'unit_kerja_id' => $unitKerja->id,
            'foto' => UploadedFile::fake()->image('avatar.jpg')
        ];

        $response = $this->actingAs($this->user)
            ->postJson('/api/pegawai', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('pegawais', ['nip' => '123456789012345678']);
        
        $pegawai = Pegawai::where('nip', '123456789012345678')->first();
        Storage::disk('public')->assertExists($pegawai->foto);
    }

    public function test_it_can_show_pegawai_detail()
    {
        $pegawai = Pegawai::factory()->create();

        $response = $this->actingAs($this->user)
            ->getJson("/api/pegawai/{$pegawai->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data.nip', $pegawai->nip);
    }

    public function test_it_can_update_pegawai()
    {
        $pegawai = Pegawai::factory()->create();
        
        $updateData = [
            'nama' => 'Nama Terupdate',
            'nip' => $pegawai->nip, // NIP tetep sama
            'tempat_lahir' => $pegawai->tempat_lahir,
            'tanggal_lahir' => $pegawai->tanggal_lahir,
            'alamat' => $pegawai->alamat,
            'jenis_kelamin' => $pegawai->jenis_kelamin,
            'golongan_id' => $pegawai->golongan_id,
            'jabatan' => $pegawai->jabatan,
            'tempat_tugas' => $pegawai->tempat_tugas,
            'agama' => $pegawai->agama,
            'unit_kerja_id' => $pegawai->unit_kerja_id,
        ];

        $response = $this->actingAs($this->user)
            ->putJson("/api/pegawai/{$pegawai->id}", $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('pegawais', ['id' => $pegawai->id, 'nama' => 'Nama Terupdate']);
    }

    public function test_it_can_delete_pegawai()
    {
        $pegawai = Pegawai::factory()->create();

        $response = $this->actingAs($this->user)
            ->deleteJson("/api/pegawai/{$pegawai->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('pegawais', ['id' => $pegawai->id]);
    }

    public function test_it_can_get_unit_kerja_tree()
    {
        $root = UnitKerja::factory()->create(['nama_unit' => 'Pusat']);
        UnitKerja::factory()->create(['nama_unit' => 'Cabang', 'parent_id' => $root->id]);

        $response = $this->actingAs($this->user)
            ->getJson('/api/unit-kerja');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'nama_unit', 'all_children'
                    ]
                ]
            ]);
    }

    public function test_it_can_get_golongan_list()
    {
        Golongan::factory()->count(3)->create();

        $response = $this->actingAs($this->user)
            ->getJson('/api/golongan');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }
}
