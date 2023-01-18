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
        return [
            Card::make('Total Pegawai', $totalPegawai),
            Card::make('Pria (%)', $jumlahPria / $totalPegawai * 100),
            Card::make('Wanita (%)', $jumlahWanita / $totalPegawai * 100)
        ];
    }
}
