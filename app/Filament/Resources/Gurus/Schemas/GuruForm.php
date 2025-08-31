<?php

namespace App\Filament\Resources\Gurus\Schemas;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Grid;

class GuruForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Diri')->schema([
                    TextInput::make('name')
                        ->required(),
                    Grid::make(2)
                    ->schema([
                        TextInput::make('nip'),
                        TextInput::make('nuptk'),
                    ]),
                    Grid::make(2)
                    ->schema([
                        TextInput::make('email')
                            ->label('Email address')
                            ->email(),
                        TextInput::make('phone')
                            ->tel(),
                       ]),
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
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->label('Foto')
                            ->responsiveImages(),
                ]),

                Section::make('Alamat')
                    ->schema([
                        Grid::make(3)
                        ->schema([
                            TextInput::make('addresses.0.dusun')
                                ->label('Dusun/Kampung'),    
                            TextInput::make('addresses.0.rt')
                                ->label('RT'),
                            TextInput::make('addresses.0.rw')
                                ->label('RW'),
                        ]),
                        Grid::make(2)
                        ->schema([
                            Select::make('addresses.0.province_id')
                                ->label('Provinsi')
                                ->options(Province::all()->pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->reactive()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    $set('addresses.0.regency_id', null);
                                    $set('addresses.0.district_id', null);
                                    $set('addresses.0.village_id', null);
                                }),
    
                            Select::make('addresses.0.regency_id')
                                ->label('Kabupaten/Kota')
                                ->options(function (callable $get) {
                                    $provinceId = $get('addresses.0.province_id');
                                    if ($provinceId) {
                                        return Regency::where('province_id', $provinceId)->pluck('name', 'id');
                                    }
                                    return [];
                                })
                                ->searchable()
                                ->reactive()
                                ->disabled(fn(callable $get) => !$get('addresses.0.province_id'))
                                ->afterStateUpdated(function (callable $set, $state) {
                                    $set('addresses.0.district_id', null);
                                    $set('addresses.0.village_id', null);
                                }),
    
                            Select::make('addresses.0.district_id')
                                ->label('Kecamatan')
                                ->options(function (callable $get) {
                                    $regencyId = $get('addresses.0.regency_id');
                                    if ($regencyId) {
                                        return District::where('regency_id', $regencyId)->pluck('name', 'id');
                                    }
                                    return [];
                                })
                                ->searchable()
                                ->reactive()
                                ->disabled(fn(callable $get) => !$get('addresses.0.regency_id'))
                                ->afterStateUpdated(function (callable $set, $state) {
                                    $set('addresses.0.village_id', null);
                                }),
    
                            Select::make('addresses.0.village_id')
                                ->label('Desa/Kelurahan')
                                ->options(function (callable $get) {
                                    $districtId = $get('addresses.0.district_id');
                                    if ($districtId) {
                                        return Village::where('district_id', $districtId)->pluck('name', 'id');
                                    }
                                    return [];
                                })
                                ->searchable()
                                ->disabled(fn(callable $get) => !$get('addresses.0.district_id')),
    
                            TextInput::make('addresses.0.postal_code')
                                ->label('Kode Pos')
                                ->numeric()
                                ->maxLength(10),
                        ]),

                    ]),
            ]);
    }
}