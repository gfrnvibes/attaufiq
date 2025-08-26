<?php

namespace App\Filament\Resources\PendaftaranSiswas\Pages;

use App\Filament\Resources\PendaftaranSiswas\PendaftaranSiswaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPendaftaranSiswa extends EditRecord
{
    protected static string $resource = PendaftaranSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
