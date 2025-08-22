<?php

namespace App\Filament\Resources\WebSettings;

use App\Filament\Resources\WebSettings\Pages\ManageWebSettings;
use App\Models\WebSetting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WebSettingResource extends Resource
{
    protected static ?string $model = WebSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Web Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('web_name')
                    ->required(),
                TextInput::make('web_tagline'),
                TextInput::make('web_description')
                    ->required(),
                TextInput::make('sambutan_kepsek'),
                TextInput::make('visi')
                    ->required(),
                TextInput::make('misi')
                    ->required(),
                Textarea::make('sejarah')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Web Settings')
            ->columns([
                TextColumn::make('web_name')
                    ->searchable(),
                TextColumn::make('web_tagline')
                    ->searchable(),
                TextColumn::make('web_description')
                    ->searchable(),
                TextColumn::make('sambutan_kepsek')
                    ->searchable(),
                TextColumn::make('visi')
                    ->searchable(),
                TextColumn::make('misi')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageWebSettings::route('/'),
        ];
    }
}
