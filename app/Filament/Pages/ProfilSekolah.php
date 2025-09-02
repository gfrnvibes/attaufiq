<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\ProfilSekolah as ProfilSekolahModel;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Grid;

class ProfilSekolah extends Page implements HasForms
{
    use InteractsWithForms;
    protected string $view = 'filament.pages.profil-sekolah';

    protected static ?string $slug = 'profil-sekolah';
    protected static ?string $title = 'Profil Sekolah/Madrasah';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;
    protected static ?string $navigationLabel = 'Profil Sekolah';
    protected static string $resource = ProfilSekolahModel::class;
    protected static string|UnitEnum|null $navigationGroup = 'Identitas Madrasah';
    public ?ProfilSekolahModel $record = null;
    public array $data = []; // state form

    public function mount(): void
    {
        // Ambil record tunggal; jika belum ada, buat record baru
        $this->record = ProfilSekolahModel::first() ?? new ProfilSekolahModel();

        // Prefill form state dari model
        $this->form->fill($this->record->toArray());
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Identitas Sekolah/Madrasah')
                ->schema([

                            SpatieMediaLibraryFileUpload::make('logo')
                                ->label('Logo Sekolah/Madrasah')
                                ->responsiveImages(),

                            Grid::make(3)
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Nama Sekolah/Madrasah')
                                        ->required()
                                        ->maxLength(255),
        
                                    TextInput::make('tagline')
                                        ->label('Tagline')
                                        ->maxLength(255),
        
                                    TextInput::make('address')
                                        ->label('Alamat')
                                        ->maxLength(255),
                                ]),

                            Textarea::make('description')
                                ->label('Deskripsi')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                            RichEditor::make('sejarah')
                                ->label('Sejarah Singkat Sekolah/Madrasah')
                                ->columnSpanFull(),
                            RichEditor::make('sambutan_kepsek')
                                ->label('Sambutan Kepala Sekolah/Madrasah')
                                ->required()
                                ->columnSpanFull(),
                ])->collapsible(),

            Section::make('Visi & Misi')
                ->schema([
                    TextInput::make('visi')
                        ->label('Visi')
                        ->required()
                        ->maxLength(255),

                    Repeater::make('misi')
                        ->label('Misi')
                        ->required()
                        ->schema([
                            TextInput::make('misi_item')
                                ->label('Isi dari Misi')
                                ->required()
                                ->maxLength(255),
                        ])->addActionLabel('Tambah Misi')
                        ->grid(2),
                ])->collapsible(),

            Section::make('Statistik')
                ->schema([
                    Repeater::make('static')
                        ->label('Pilih Satu Kali')
                        ->schema([
                            Select::make('nama')
                                ->options([
                                    'siswa' => 'Siswa',
                                    'alumni' => 'Alumni',
                                    'guru' => 'Guru',
                                    'kelas' => 'Kelas',
                                ]),
                            TextInput::make('jumlah')
                                ->placeholder('Contoh: 1000')
                                ->maxLength(255)
                        ])
                        ->defaultItems(5)
                        ->addActionLabel('Tambah Statistik')
                        ->grid(3),
                ])->collapsible(),

            Section::make('Link Media Sosial')
                ->schema([
                    Repeater::make('social')
                        ->label('Pilih Satu Kali')
                        ->schema([
                            Select::make('nama')
                                ->options([
                                    'telepon' => 'Telepon',
                                    'email' => 'Email',
                                    'facebook' => 'Facebook',
                                    'instagram' => 'Instagram',
                                ]),
                            TextInput::make('link')
                                ->placeholder('Contoh: https://www.facebook.com/mtsattaufiq')
                                ->maxLength(255)
                        ])
                        ->addActionLabel('Tambah Media Sosial')
                        ->grid(3),
                ])->collapsible(),
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

    protected function getFormModel(): ProfilSekolahModel
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