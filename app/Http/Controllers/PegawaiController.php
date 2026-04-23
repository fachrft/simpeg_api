<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pegawai::with(['golongan', 'unitKerja']);

        if($request->has('search') ) {
          $search = $request->search;
          $query->where(function($q) use ($search) {
            $q->where('nip', 'like', '%'.$search.'%')
              ->orWhere('nama', 'like', '%'.$search.'%');
          });
        }

        if($request->has('unit_kerja_id')) {
          $query->where('unit_kerja_id', $request->unit_kerja_id);
        }

        $perPage = $request->get('per_page', 10);
        $pegawais = $query->paginate($perPage);

        return response()->json([
          'success' => true,
          'message' => 'Data Pegawai',
          'data' => $pegawais,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePegawaiRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $pegawai = Pegawai::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data pegawai',
            'data' => $pegawai
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail data pegawai',
            'data' => $pegawai->load(['golongan', 'unitKerja'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $data['foto'] = $request->file('foto')->store('pegawai', 'public');
        }

        $pegawai->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengubah data pegawai',
            'data' => $pegawai
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        if ($pegawai->foto) {
            Storage::disk('public')->delete($pegawai->foto);
        }
        
        $pegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data pegawai'
        ]);
    }
}
