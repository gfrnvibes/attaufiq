<?php

namespace App\Filament\Resources\Gurus\Pages;

use App\Filament\Resources\Gurus\GuruResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGuru extends EditRecord
{
    protected static string $resource = GuruResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $addressData = $this->data['addresses'][0] ?? [];

        if ($this->record->addresses()->count() > 0) {
            $this->record->addresses()->first()->update($addressData);
        } else {
            $this->record->addresses()->create($addressData);
        }
    }
}