<?php

namespace App\Filament\Resources\Prestasis\Pages;

use App\Filament\Resources\Prestasis\PrestasiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePrestasis extends ManageRecords
{
    protected static string $resource = PrestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
