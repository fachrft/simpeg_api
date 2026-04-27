<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    /** @use HasFactory<\Database\Factories\UnitKerjaFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(UnitKerja::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(UnitKerja::class, 'parent_id');
    }

    // public function allChildren()
    // {
    //     return $this->children()->with('allChildren');
    // }

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
