<?php

namespace App\Filament\Resources\PendaftaranSiswas;

use App\Filament\Resources\PendaftaranSiswas\Pages\CreatePendaftaranSiswa;
use App\Filament\Resources\PendaftaranSiswas\Pages\EditPendaftaranSiswa;
use App\Filament\Resources\PendaftaranSiswas\Pages\ListPendaftaranSiswas;
use App\Filament\Resources\PendaftaranSiswas\Pages\ViewPendaftaranSiswa;
use App\Filament\Resources\PendaftaranSiswas\Schemas\PendaftaranSiswaForm;
use App\Filament\Resources\PendaftaranSiswas\Schemas\PendaftaranSiswaInfolist;
use App\Filament\Resources\PendaftaranSiswas\Tables\PendaftaranSiswasTable;
use App\Models\PendaftaranSiswa;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PendaftaranSiswaResource extends Resource
{
    protected static ?string $model = PendaftaranSiswa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $title = 'Pendaftar Peserta Didik Baru';
    protected static ?string $navigationLabel = 'Pendaftaran Peserta';
    protected static string|UnitEnum|null $navigationGroup = 'PPDB';

    public static function form(Schema $schema): Schema
    {
        return PendaftaranSiswaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PendaftaranSiswaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PendaftaranSiswasTable::configure($table);
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
            'index' => ListPendaftaranSiswas::route('/'),
            'create' => CreatePendaftaranSiswa::route('/create'),
            'view' => ViewPendaftaranSiswa::route('/{record}'),
            'edit' => EditPendaftaranSiswa::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
