<?php

namespace App\Filament\Resources\PendaftaranSiswas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
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
                            ->label('Nama Lengkap')
                            ->required(),
                        TextInput::make('nik')
                            ->label('NIK')
                            ->rule('digits:16') // atau minLength/maxLength
                            ->extraInputAttributes(['inputmode' => 'numeric']) // biar keypad angka muncul di HP
                            ->required(),
                        TextInput::make('nisn')
                            ->label('NISN')
                            ->numeric()
                            ->length(10)
                            ->required(),
                        Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                            ->required(),
                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required(),
                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),
                        TextInput::make('asal_sekolah')
                            ->label('Asal Sekolah')
                            ->required(),
                        TextInput::make('anak_ke')
                            ->required()
                            ->numeric(),
                        TextInput::make('jumlah_saudara_kandung')
                            ->required()
                            ->numeric(),
                        TextInput::make('no_hp')
                            ->label('No. HP')
                            ->required(),
                        KeyValue::make('prestasi')
                            ->nullable(),
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
                Section::make('Unggah Dokumen Siswa')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                    ])
                    ->schema([                   
                        SpatieMediaLibraryFileUpload::make('document')
                            ->multiple()
                            ->maxSize(2048)
                            ->label('Unggah Dokumen yang diperlukan (max 2MB)'),
                    ])
                    ->columnSpanFull(),
            ]);
    }

}
