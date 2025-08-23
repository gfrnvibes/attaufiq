<?php

namespace App\Filament\Resources\Ekskuls\Pages;

use App\Filament\Resources\Ekskuls\EkskulResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageEkskuls extends ManageRecords
{
    protected static string $resource = EkskulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
