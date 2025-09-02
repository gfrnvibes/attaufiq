<?php

namespace App\Filament\Resources\Ekskuls;

use App\Filament\Resources\Ekskuls\Pages\ManageEkskuls;
use App\Models\Ekskul;
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
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use UnitEnum;

class EkskulResource extends Resource
{
    protected static ?string $model = Ekskul::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Bolt;

    protected static ?string $recordTitleAttribute = 'Extra Kulikuler';
    protected static string|UnitEnum|null $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Extra Kulikuler';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('gambar')
                    ->collection('thumbnail')
                    ->label('Gambar'),
                TextInput::make('nama_ekskul')
                    ->required()
                    ->maxLength(255),
                TextInput::make('deskripsi_ekskul')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Extra Kulikuler')
            ->columns([
                SpatieMediaLibraryImageColumn::make('gambar')
                    ->collection('thumbnail')
                    ->label('Gambar'),
                TextColumn::make('nama_ekskul')
                    ->searchable(),
                TextColumn::make('deskripsi_ekskul')
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
            'index' => ManageEkskuls::route('/'),
        ];
    }
}
