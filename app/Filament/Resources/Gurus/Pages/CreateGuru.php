<?php

namespace App\Filament\Resources\Gurus\Pages;

use App\Filament\Resources\Gurus\GuruResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGuru extends CreateRecord
{
    protected static string $resource = GuruResource::class;

    protected function afterCreate(): void
    {
        $this->record->addresses()->create(
            $this->data['addresses'][0] ?? []
        );
    }
}