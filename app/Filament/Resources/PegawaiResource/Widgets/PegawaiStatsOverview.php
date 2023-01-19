<?php

namespace App\Filament\Resources\PegawaiResource\Widgets;

use App\Models\Pegawai;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PegawaiStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $totalPegawai = Pegawai::all()->count();
        $jumlahPria = Pegawai::where('gender', 'Pria')->count();
        $jumlahWanita = Pegawai::where('gender', 'Wanita')->count();

        $persenPria = 0;
        $persenWanita = 0;
        if ($totalPegawai > 0) {
            $persenPria = number_format(($jumlahPria / $totalPegawai) * 100, 2);
            $persenWanita = number_format(($jumlahWanita / $totalPegawai) * 100, 2);
        }

        return [
            Card::make('Total Pegawai', $totalPegawai),
            Card::make('Pria (%)', $persenPria),
            Card::make('Wanita (%)', $persenWanita),
        ];
    }
}
