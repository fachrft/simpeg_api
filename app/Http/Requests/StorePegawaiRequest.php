<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nip' => 'required|string|max:18|unique:pegawais,nip',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'golongan_id' => 'required|exists:golongans,id',
            'eselon' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tempat_tugas' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
            'no_hp' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255'
        ];
    }
}
