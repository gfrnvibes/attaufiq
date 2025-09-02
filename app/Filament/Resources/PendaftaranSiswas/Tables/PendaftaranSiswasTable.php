<?php

namespace App\Filament\Resources\PendaftaranSiswas\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class PendaftaranSiswasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),
                TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->toggleable(),
                TextColumn::make('tempat_lahir')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tanggal_lahir')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('asal_sekolah')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('anak_ke')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('jumlah_saudara_kandung')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('no_hp')
                    ->label('No HP')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'tolak' => 'Ditolak',
                        'terima' => 'Diterima',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'terima' => 'success',
                        'ditolak' => 'danger',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->multiple()
                    ->options([
                        'pending' => 'Pending',
                        'terima' => 'Diterima',
                        'tolak' => 'Ditolak',
                    ])
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),

                    Action::make('terima')
                        ->label('Terima')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn($record) => $record->update(['status' => 'terima']))
                        ->requiresConfirmation()
                        ->modalHeading('Terima Pendaftaran')
                        ->modalDescription('Apakah Anda yakin ingin menerima pendaftaran ini?')
                        ->modalSubmitActionLabel('Ya, Terima'),

                    Action::make('tolak')
                        ->label('Tolak')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn($record) => $record->update(['status' => 'tolak']))
                        ->requiresConfirmation()
                        ->modalHeading('Tolak Pendaftaran')
                        ->modalDescription('Apakah Anda yakin ingin menolak pendaftaran ini?')
                        ->modalSubmitActionLabel('Ya, Tolak'),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
