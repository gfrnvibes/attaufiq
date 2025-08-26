<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\PeriodePendaftaran as PeriodePendaftaranModel;

class PeriodePendaftaran extends Page implements HasForms
{
    use InteractsWithForms;
    protected string $view = 'filament.pages.periode-pendaftaran';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;
    protected static ?string $title = 'Periode PPDB';
    protected static ?string $navigationLabel = 'Periode PPDB';
    protected static string|UnitEnum|null $navigationGroup = 'PPDB';
    public ?PeriodePendaftaranModel $record = null;
    public array $data = []; // state form

    public function mount(): void
    {
        // Ambil record tunggal; jika belum ada, buat record baru
        $this->record = PeriodePendaftaranModel::first() ?? new PeriodePendaftaranModel();

        // Prefill form state dari model
        $this->form->fill($this->record->toArray());
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    Select::make('periode')
                        ->options([
                            'gelombang_1' => 'Gelombang 1',
                            'gelombang_2' => 'Gelombang 2',
                            'gelombang_3' => 'Gelombang 3',
                        ]),
                    DatePicker::make('tanggal_mulai')
                        ->label('Tanggal Mulai')
                        ->date()
                        ->required(),
                    DatePicker::make('tanggal_selesai')
                        ->label('Tanggal Selesai')
                        ->date()
                        ->required(),
                    Toggle::make('is_active')
                        ->inline()
                        ->onColor('success')
                        ->offColor('danger')
                        ->required(),
                ])
        ];
    }

    protected function getFormModel(): PeriodePendaftaranModel
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
