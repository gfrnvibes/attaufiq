<?php

namespace App\Filament\Resources\PendaftaranSiswas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PendaftaranSiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section 1: Data Siswa
                Section::make('Data Siswa')
                    ->columns([
                        'sm' => 1,
                        'xl' => 3,
                    ])
                    ->schema([
                        TextInput::make('nama_lengkap')
                            ->required(),
                        TextInput::make('nik')
                            ->required(),
                        Select::make('jenis_kelamin')
                            ->options(['L' => 'L', 'P' => 'P'])
                            ->required(),
                        TextInput::make('tempat_lahir')
                            ->required(),
                        DatePicker::make('tanggal_lahir')
                            ->required(),
                        TextInput::make('asal_sekolah')
                            ->required(),
                        TextInput::make('nisn'),
                        TextInput::make('anak_ke')
                            ->required()
                            ->numeric(),
                        TextInput::make('jumlah_saudara_kandung')
                            ->required()
                            ->numeric(),
                        TextInput::make('no_hp')
                            ->required(),
                        TextInput::make('prestasi'),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                // Section 2: Data Orang Tua Siswa (Relasi)
                Section::make('Data Orang Tua Siswa')
                    ->schema([
                        Repeater::make('orangTuaSiswa')
                            ->relationship('orangTuaSiswa')
                            ->columns([
                                'sm' => 1,
                                'xl' => 3,
                            ])
                            ->schema([
                                Hidden::make('siswa_id'),

                                TextInput::make('nomor_kartu_keluarga')
                                    ->required(),

                                Select::make('Sebagai')
                                    ->options([
                                        'ayah' => 'Ayah',
                                        'ibu' => 'Ibu',
                                        'wali' => 'Wali',
                                    ])
                                    ->required()
                                    ->reactive(), // penting biar trigger update ke field lain

                                TextInput::make('nama')
                                    ->required(),

                                TextInput::make('nik')
                                    ->required(),

                                TextInput::make('pendidikan'),

                                TextInput::make('pekerjaan'),

                                TextInput::make('no_hp'),

                                Select::make('keadaan')
                                    ->options([
                                        'hidup' => 'Hidup',
                                        'alm' => 'Wafat',
                                    ])
                                    ->required(),

                                // Field Hubungan -> muncul hanya kalau tipe = wali
                                Select::make('hubungan')
                                    ->options([
                                        'paman' => 'Paman',
                                        'bibi' => 'Bibi',
                                        'kakak' => 'Kakak',
                                        'lainnya' => 'Lainnya',
                                    ])
                                    ->visible(fn(callable $get) => $get('tipe') === 'wali') // tampil kalau wali
                                    ->required(fn(callable $get) => $get('tipe') === 'wali'),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                // Section 3: Unggah File Siswa
                Section::make('Unggah File Siswa')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                    ])
                    ->schema([                   
                        SpatieMediaLibraryFileUpload::make('ijazah')
                            ->label('Ijazah (Legalisir)'),
                        SpatieMediaLibraryFileUpload::make('ktp_ayah')
                            ->label('KTP Ayah'),
                        SpatieMediaLibraryFileUpload::make('ktp_ibu')
                            ->label('KTP Ibu'),
                        SpatieMediaLibraryFileUpload::make('akta')
                            ->label('Akta Kelahiran'),
                        SpatieMediaLibraryFileUpload::make('kk')
                            ->label('Kartu Keluarga'),
                        SpatieMediaLibraryFileUpload::make('nisn')
                            ->label('NISN'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

}
