<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nik',
        'nama',
        'tanggal_lahir',
        'gender',
        'nomor_hp',
        'email'
    ];

    protected $appends = [
        'usia'
    ];

    public function suratMasuks()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    public function suratKeluars()
    {
        return $this->hasMany(SuratKeluar::class);
    }

    public function getUsiaAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}
