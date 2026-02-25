<?php

namespace App\Filament\Resources\SlotServices;

use App\Filament\Resources\SlotServices\Pages\CreateSlotService;
use App\Filament\Resources\SlotServices\Pages\EditSlotService;
use App\Filament\Resources\SlotServices\Pages\ListSlotServices;
use App\Filament\Resources\SlotServices\Schemas\SlotServiceForm;
use App\Filament\Resources\SlotServices\Tables\SlotServicesTable;
use App\Models\SlotService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SlotServiceResource extends Resource
{
    protected static ?string $model = SlotService::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;
    protected static ?string $navigationLabel = 'Slot Pelayanan';
    protected static ?string $modelLabel = 'Slot Pelayanan';
    protected static ?string $pluralModelLabel = 'Slot Pelayanan';
    protected static string | UnitEnum | null $navigationGroup = 'Proses Data';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return SlotServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SlotServicesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSlotServices::route('/'),
            'create' => CreateSlotService::route('/create'),
            'edit' => EditSlotService::route('/{record}/edit'),
        ];
    }
}
