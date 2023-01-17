<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPSTORM_META\map;

class SuratMasuk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nomor',
        'tanggal',
        'pengirim',
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
