<?php

namespace App\Filament\Resources\Prestasis;

use App\Filament\Resources\Prestasis\Pages\ManagePrestasis;
use App\Models\Prestasi;
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


class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Trophy;

    protected static ?string $recordTitleAttribute = 'Prestasi';
    protected static ?string $navigationLabel = 'Prestasi';

    protected static string|UnitEnum|null $navigationGroup = 'Kesiswaan';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_prestasi')
                    ->required()
                    ->maxLength(255),
                TextInput::make('deskripsi_prestasi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Prestasi')
            ->columns([
                TextColumn::make('nama_prestasi')
                    ->searchable(),
                TextColumn::make('deskripsi_prestasi')
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
            'index' => ManagePrestasis::route('/'),
        ];
    }
}
