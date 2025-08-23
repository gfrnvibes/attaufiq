<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use App\Models\WebSetting as WebSettingModel;
use Filament\Forms\Concerns\InteractsWithForms;

class WebSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.web-setting';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;
    protected static ?string $navigationLabel = 'Web Settings';
    protected static string $resource = WebSettingModel::class;
    public ?WebSettingModel $record = null;
    public array $data = []; // state form

    public function mount(): void
    {
        // Ambil record tunggal; kalau belum ada, create.
        $this->record = WebSettingModel::first() ?? WebSettingModel::create([]);

        // Prefill form state dari model
        $this->form->fill($this->record->toArray());
    }

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('web_logo')
                ->label('Logo Website')
                ->image()
                ->visibility('public')
                ->directory('web-settings')
                ->preserveFilenames()
                // ->collection('web_logo')
                ->nullable(),
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
                ->maxLength(255),
            Textarea::make('sambutan_kepsek')
                ->label('Sambutan Kepala Sekolah')
                ->required(),
            Textarea::make('visi')
                ->label('Visi')
                ->required(),
            KeyValue::make('misi')
                ->keyLabel('No')
                ->valueLabel('Misi')
                ->addActionLabel('Add property'),
            Textarea::make('sejarah')
                ->label('Sejarah Sekolah')
                ->required(),
            
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