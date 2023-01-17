<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratKeluarResource\Pages;
use App\Filament\Resources\SuratKeluarResource\RelationManagers;
use App\Models\SuratKeluar;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratKeluarResource extends Resource
{
    protected static ?string $model = SuratKeluar::class;

    protected static ?string $navigationIcon = 'heroicon-o-mail';

    protected static ?string $navigationLabel = 'Surat Keluar';

    protected static ?string $pluralModelLabel  = 'Surat Keluar';

    protected static ?string $navigationGroup = 'Surat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('tanggal')
                            ->required(),
                        TextInput::make('kepada')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('perihal')
                            ->required()
                            ->maxLength(255),
                        Select::make('pegawai_id')
                            ->relationship('pegawai', 'nama')
                            ->createOptionForm([
                                Section::make('Data')
                                    ->columns(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('nik')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('nama')
                                            ->required(),
                                        Forms\Components\DateTimePicker::make('tanggal_lahir')
                                            ->required(),
                                        Forms\Components\Select::make('gender')
                                            ->required()
                                            ->options([
                                                'Pria' => 'Pria',
                                                'Wanita' => 'Wanita'
                                            ]),
                                    ]),
                                Section::make('Kontak')
                                    ->columns(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('nomor_hp')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('email')
                                            ->email()
                                            ->maxLength(255),
                                    ]),
                            ]),
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
                            ->directory('surat-keluar')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pegawai_id'),
                Tables\Columns\TextColumn::make('tanggal')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('kepada'),
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
            'index' => Pages\ListSuratKeluars::route('/'),
            'create' => Pages\CreateSuratKeluar::route('/create'),
            'edit' => Pages\EditSuratKeluar::route('/{record}/edit'),
        ];
    }
}
