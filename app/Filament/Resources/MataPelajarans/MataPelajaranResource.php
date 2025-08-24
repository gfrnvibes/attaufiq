<?php

namespace App\Filament\Resources\MataPelajarans;

use App\Filament\Resources\MataPelajarans\Pages\ManageMataPelajarans;
use App\Models\MataPelajaran;
use UnitEnum;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MataPelajaranResource extends Resource
{
    protected static ?string $model = MataPelajaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::QueueList;

    protected static ?string $recordTitleAttribute = 'Mata Pelajaran';
    protected static ?string $navigationLabel = 'Mata Pelajaran';
    protected static string|UnitEnum|null $navigationGroup = 'Guru & Siswa';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_mapel')
                    ->label('Nama Mata Pelajaran')
                    ->required()
                    ->maxLength(255),
                TextInput::make('deskripsi_mapel')
                    ->maxLength(255)
                    ->label('Deskripsi Mata Pelajaran'),
                Select::make('gurus')
                    ->label('Guru Pengajar')
                    ->relationship('gurus', 'name')
                    ->required()
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_mapel')
            ->columns([
                TextColumn::make('nama_mapel')
                    ->label('Nama Mata Pelajaran')
                    ->searchable(),
                TextColumn::make('deskripsi_mapel')
                    ->label('Deskripsi Mata Pelajaran'),
                TextColumn::make('gurus.name')
                    ->label('Guru Pengajar'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMataPelajarans::route('/'),
        ];
    }
}
