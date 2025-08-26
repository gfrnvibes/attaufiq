<?php

namespace App\Filament\Resources\PendaftaranSiswas\Pages;

use App\Filament\Resources\PendaftaranSiswas\PendaftaranSiswaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPendaftaranSiswas extends ListRecords
{
    protected static string $resource = PendaftaranSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
