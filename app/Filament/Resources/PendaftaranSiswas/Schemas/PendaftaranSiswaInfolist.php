<?php

namespace App\Filament\Resources\PendaftaranSiswas\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

class PendaftaranSiswaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'sm' => 1,
                'xl' => 3,
            ])
            ->components([
                TextEntry::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->size(TextSize::Large),
                TextEntry::make('nik')
                    ->label('NIK')
                    ->size(TextSize::Large),
                TextEntry::make('nisn')
                    ->label('NISN')
                    ->size(TextSize::Large),
                TextEntry::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    })
                    ->size(TextSize::Large),
                TextEntry::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->size(TextSize::Large),
                TextEntry::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date()
                    ->size(TextSize::Large),
                TextEntry::make('asal_sekolah')
                    ->label('Asal Sekolah')
                    ->size(TextSize::Large),
                TextEntry::make('anak_ke')
                    ->label('Anak Ke')
                    ->numeric()
                    ->size(TextSize::Large),
                TextEntry::make('jumlah_saudara_kandung')
                    ->label('Jumlah Saudara Kandung')
                    ->numeric()
                    ->size(TextSize::Large),
                TextEntry::make('no_hp')
                    ->label('No HP')
                    ->size(TextSize::Large),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->size(TextSize::Large),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->size(TextSize::Large),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'tolak' => 'Ditolak',
                        'terima' => 'Diterima',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'terima' => 'success',
                        'ditolak' => 'danger',
                    })->size(TextSize::Large),
                SpatieMediaLibraryImageEntry::make('document'),
            ]);
    }
}
