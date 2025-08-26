<?php

namespace App\Filament\Resources\PendaftaranSiswas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PendaftaranSiswaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama_lengkap'),
                TextEntry::make('nik'),
                TextEntry::make('jenis_kelamin'),
                TextEntry::make('tempat_lahir'),
                TextEntry::make('tanggal_lahir')
                    ->date(),
                TextEntry::make('asal_sekolah'),
                TextEntry::make('nisn'),
                TextEntry::make('anak_ke')
                    ->numeric(),
                TextEntry::make('jumlah_saudara_kandung')
                    ->numeric(),
                TextEntry::make('no_hp'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
