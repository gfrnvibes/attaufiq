<?php

namespace App\Filament\Resources\Fasilitas;

use App\Filament\Resources\Fasilitas\Pages\ManageFasilitas;
use App\Models\Fasilitas;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice;
    protected static string|UnitEnum|null $navigationGroup = 'Identitas Madrasah';

    protected static ?string $recordTitleAttribute = 'Fasilitas';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_fasilitas')
                    ->required(),
                TextInput::make('deskripsi_fasilitas'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Fasilitas')
            ->columns([
                TextColumn::make('nama_fasilitas')
                    ->searchable(),
                TextColumn::make('deskripsi_fasilitas')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ManageFasilitas::route('/'),
        ];
    }
}
