<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use App\Models\WebSetting as WebSettingModel;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

class WebSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $slug = 'profil-madrasah';
    protected string $view = 'filament.pages.web-setting';
    protected static ?string $title = 'Profil Madrasah';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;
    protected static ?string $navigationLabel = 'Profil Madrasah';
    protected static string $resource = WebSettingModel::class;
    protected static string|UnitEnum|null $navigationGroup = 'Identitas Madrasah';
    public ?WebSettingModel $record = null;
    public array $data = []; // state form

    public function mount(): void
    {
        // Ambil record tunggal; jika belum ada, buat record baru
        $this->record = WebSettingModel::first() ?? new WebSettingModel();

        // Prefill form state dari model
        $this->form->fill($this->record->toArray());
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('Logo')
                    ->responsiveImages(),
                    TextInput::make('web_name')
                        ->label('Nama Website')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('web_tagline')
                        ->label('Tagline')
                        ->required()
                        ->maxLength(255),

                    Textarea::make('web_description')
                        ->label('Deskripsi')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Textarea::make('sambutan_kepsek')
                        ->label('Sambutan Kepala Sekolah')
                        ->required()
                        ->columnSpanFull(),

                    Textarea::make('visi')
                        ->label('Visi')
                        ->required()
                        ->columnSpanFull(),

                    KeyValue::make('misi')
                        ->keyLabel('No')
                        ->valueLabel('Misi')
                        ->addActionLabel('Tambah Misi')
                        ->columnSpanFull(),

                    Textarea::make('sejarah')
                        ->label('Sejarah Madrasah')
                        ->required()
                        ->columnSpanFull(),
                ])
        ];
    }

    protected function afterCreate(): void
    {
        $this->syncMedia();
    }

    protected function syncMedia(): void
    {
        $files = $this->form->getState()['web_logo'] ?? [];

        foreach ((array) $files as $path) {
            // $path contoh: tmp/posts/abc.jpg (di disk 'public')
            $this->record
                ->addMediaFromDisk($path, 'public')
                ->toMediaCollection('images');
        }

        // Optional: beres-beres file sementara
        Storage::disk('public')->delete((array) $files);

        // Clear state biar ga ke-save lagi
        $this->form->fill(['images' => []]);
    }

    protected function getFormModel(): WebSettingModel
    {
        return $this->record;
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $this->record->fill($this->form->getState());
        $this->record->save();

        Notification::make()
            ->title('Saved!')
            ->success()
            ->send();
    }
}