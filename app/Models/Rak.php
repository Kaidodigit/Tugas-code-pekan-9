<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $table = 'rak';

    protected $primaryKey = 'Kode_Rak';   
    public $incrementing = false;          
    protected $keyType = 'string';        
    public $timestamps = false;

    protected $fillable = [
        'Kode_Rak',
        'Zona',
        'Lorong',
        'Level',
        'kapasitas',
        'isi_rak',
    ];
}