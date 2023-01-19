<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Filament\Resources\PegawaiResource\RelationManagers;
use App\Filament\Resources\PegawaiResource\Widgets\PegawaiStatsOverview;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Layout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Pegawai';

    protected static ?string $pluralModelLabel  = 'Pegawai';

    protected static ?string $navigationGroup = 'Pegawai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make('Data Pribadi')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('nik')
                                    ->unique(Pegawai::class, 'nik', ignoreRecord: true)
                                    ->regex('/^[0-9]*$/')
                                    ->length(16),
                                Forms\Components\TextInput::make('nama')
                                    ->required(),
                                Forms\Components\DateTimePicker::make('tanggal_lahir')
                                    ->required()
                                    ->minDate(now()->subYears(70))
                                    ->maxDate(now()->subYears(15)),
                                Forms\Components\Select::make('gender')
                                    ->required()
                                    ->options([
                                        'Pria' => 'Pria',
                                        'Wanita' => 'Wanita'
                                    ]),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()
                    ->schema([
                        Section::make('Kontak')
                            ->schema([
                                Forms\Components\TextInput::make('nomor_hp')
                                    ->unique(Pegawai::class, 'nomor_hp', ignoreRecord: true)
                                    ->regex('/^[0-9]*$/')
                                    ->minLength(10)
                                    ->maxLength(13),
                                Forms\Components\TextInput::make('email')
                                    ->unique(Pegawai::class, 'email', ignoreRecord: true)
                                    ->email()
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('usia'),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->sortable()
                    ->searchable()
                    ->date(),
                Tables\Columns\TextColumn::make('gender')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomor_hp')
                    ->searchable(),
            ])
            ->filters([
                //  
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            PegawaiStatsOverview::class
        ];
    }
}
