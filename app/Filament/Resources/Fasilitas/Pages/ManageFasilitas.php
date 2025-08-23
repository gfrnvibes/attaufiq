<?php

namespace App\Filament\Resources\Fasilitas\Pages;

use App\Filament\Resources\Fasilitas\FasilitasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageFasilitas extends ManageRecords
{
    protected static string $resource = FasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
