<?php

namespace App\Filament\Resources\PendaftaranSiswas\Pages;

use App\Filament\Resources\PendaftaranSiswas\PendaftaranSiswaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPendaftaranSiswa extends ViewRecord
{
    protected static string $resource = PendaftaranSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
