<?php

namespace App\Filament\Resources\Dokumentasis;

use BackedEnum;
use Filament\Tables\Table;
use App\Models\Dokumentasi;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\Dokumentasis\Pages\ManageDokumentasis;
use UnitEnum;

class DokumentasiResource extends Resource
{
    protected static ?string $model = Dokumentasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Photo;

    protected static ?string $recordTitleAttribute = 'Dokumentasi';
    protected static ?string $navigationLabel = 'Dokumentasi';

    protected static string|UnitEnum|null $navigationGroup = 'Kesiswaan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul_kegiatan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('deskripsi_kegiatan')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('tgl_kegiatan')
                    ->required()
                    ->date(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Dokumentasi')
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('judul_kegiatan')
                    ->searchable(),
                TextColumn::make('deskripsi_kegiatan')
                    ->searchable(),
                TextColumn::make('tgl_kegiatan')
                    ->date()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ManageDokumentasis::route('/'),
        ];
    }
}
