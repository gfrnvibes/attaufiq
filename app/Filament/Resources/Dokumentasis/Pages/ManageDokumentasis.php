<?php

namespace App\Filament\Resources\Dokumentasis\Pages;

use App\Filament\Resources\Dokumentasis\DokumentasiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDokumentasis extends ManageRecords
{
    protected static string $resource = DokumentasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
