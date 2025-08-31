<x-filament-panels::page>
        <form wire:submit.prevent="save" class="">
            {{ $this->form }}
            <br>
            <x-filament::button type="submit">
                Simpan
            </x-filament::button>
        </form>
</x-filament-panels::page>
