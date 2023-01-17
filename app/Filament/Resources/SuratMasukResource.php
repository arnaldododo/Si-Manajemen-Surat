<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratMasukResource\Pages;
use App\Filament\Resources\SuratMasukResource\RelationManagers;
use App\Models\Pegawai;
use App\Models\SuratMasuk;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratMasukResource extends Resource
{
    protected static ?string $model = SuratMasuk::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'Surat Masuk';

    protected static ?string $pluralModelLabel  = 'Surat Masuk';

    protected static ?string $navigationGroup = 'Surat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('nomor')
                            ->label('Nomor Surat')
                            ->maxLength(255),
                        DateTimePicker::make('tanggal')
                            ->required(),
                        TextInput::make('pengirim')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('perihal')
                            ->required()
                            ->maxLength(255),
                        Select::make('pegawai_id')
                            ->relationship('pegawai', 'nama'),
                    ]),
                Section::make('Isi surat / Ringkasan')
                    ->schema([
                        RichEditor::make('isi')
                            ->maxLength(255),
                    ]),
                Section::make('File surat')
                    ->schema([
                        FileUpload::make('file')
                            ->disk('public')
                            ->directory('surat-masuk')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pegawai.nama'),
                Tables\Columns\TextColumn::make('nomor'),
                Tables\Columns\TextColumn::make('tanggal')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('pengirim'),
                Tables\Columns\TextColumn::make('perihal'),
                Tables\Columns\TextColumn::make('file'),
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
            'index' => Pages\ListSuratMasuks::route('/'),
            'create' => Pages\CreateSuratMasuk::route('/create'),
            'edit' => Pages\EditSuratMasuk::route('/{record}/edit'),
        ];
    }
}
