<?php

namespace App\Filament\Resources\WebSettings\Pages;

use App\Filament\Resources\WebSettings\WebSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageWebSettings extends ManageRecords
{
    protected static string $resource = WebSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
