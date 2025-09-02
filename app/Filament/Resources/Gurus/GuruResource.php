<?php

namespace App\Filament\Resources\Gurus;

use UnitEnum;
use BackedEnum;
use App\Models\Guru;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Gurus\Pages\EditGuru;
use App\Filament\Resources\Gurus\Pages\ViewGuru;
use App\Filament\Resources\Gurus\Pages\ListGurus;
use App\Filament\Resources\Gurus\Pages\CreateGuru;
use App\Filament\Resources\Gurus\Schemas\GuruForm;
use App\Filament\Resources\Gurus\Tables\GurusTable;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::AcademicCap;
    protected static ?string $recordTitleAttribute = 'Guru';
    protected static ?string $navigationLabel = 'Guru';
    protected static string|UnitEnum|null $navigationGroup = 'Guru & Siswa';

    public static function form(Schema $schema): Schema
    {
        return GuruForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GurusTable::configure($table);
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
            'index' => ListGurus::route('/'),
            'create' => CreateGuru::route('/create'),
            'edit' => EditGuru::route('/{record}/edit'),
            'view' => ViewGuru::route('/{record}'),
        ];
    }
}
