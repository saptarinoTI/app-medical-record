<?php

namespace App\Filament\Resources\PermitServices;

use App\Filament\Resources\PermitServices\Pages\CreatePermitService;
use App\Filament\Resources\PermitServices\Pages\EditPermitService;
use App\Filament\Resources\PermitServices\Pages\ListPermitServices;
use App\Filament\Resources\PermitServices\Schemas\PermitServiceForm;
use App\Filament\Resources\PermitServices\Tables\PermitServicesTable;
use App\Models\PermitService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PermitServiceResource extends Resource
{
    protected static ?string $model = PermitService::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;
    protected static ?string $navigationLabel = 'Izin Pelayanan Aktif';
    protected static ?string $modelLabel = 'Izin Pelayanan Aktif';
    protected static ?string $pluralModelLabel = 'Izin Pelayanan Aktif';
    protected static string | UnitEnum | null $navigationGroup = 'Proses Data';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return PermitServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PermitServicesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPermitServices::route('/'),
            'create' => CreatePermitService::route('/create'),
            'edit' => EditPermitService::route('/{record}/edit'),
        ];
    }
}
