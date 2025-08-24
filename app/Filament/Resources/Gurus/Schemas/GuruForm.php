<?php

namespace App\Filament\Resources\Gurus\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class GuruForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('Foto')
                    ->responsiveImages(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('nip'),
                TextInput::make('nuptk'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                Select::make('jabatan')
                    ->required()
                    ->options([
                        'guru' => 'Guru',
                        'kepsek' => 'Kepala Madrasah',
                        'sekretaris' => 'Sekretaris',
                        'bendahara' => 'Bendahara',
                    ])
                    ->default('guru'),
                Select::make('mata_pelajarans')
                    ->required()
                    ->relationship('mataPelajarans', 'nama_mapel')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ]);
    }
}
