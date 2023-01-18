<?php

namespace App\Filament\Resources\PegawaiResource\Pages;

use App\Filament\Resources\PegawaiResource;
use App\Filament\Resources\PegawaiResource\Widgets\PegawaiStatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPegawais extends ListRecords
{
    protected static string $resource = PegawaiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PegawaiStatsOverview::class
        ];
    }
}
