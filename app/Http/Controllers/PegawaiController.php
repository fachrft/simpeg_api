<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pegawai::query();

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
