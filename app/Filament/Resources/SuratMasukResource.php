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
                            ->label('Pegawai bersangkutan (PIC)')
                            ->relationship('pegawai', 'nama')
                            ->createOptionForm([
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
                                    ]),
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
                                    ]),
                            ]),
                    ]),
                Section::make('Isi surat / Ringkasan')
                    ->schema([
                        RichEditor::make('isi')
                            ->maxLength(255)
                            ->disableLabel(),
                    ]),
                Section::make('File surat')
                    ->schema([
                        FileUpload::make('file')
                            ->disk('public')
                            ->directory('surat-masuk')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf'])
                            ->disableLabel(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pegawai.nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->sortable()
                    ->searchable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('pengirim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('perihal')
                    ->searchable(),
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
