<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratKeluar extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nomor',
        'tanggal',
        'kepada',
        'perihal',
        'isi',
        'file',
        'pegawai_id'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
