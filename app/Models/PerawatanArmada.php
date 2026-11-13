<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerawatanArmada extends Model
{
    // Arahkan ke tabel yang tepat
    protected $table = 'perawatan_armada';

    // Matikan timestamps bawaan karena tabel hanya punya create_at
    public $timestamps = false; 

    // Tentukan kolom mana saja yang boleh diisi melalui form (Mass Assignment)
    protected $fillable = [
        'nomor_seri',
        'tanggal_perawatan',
    ];
}