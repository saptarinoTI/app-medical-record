<?php

namespace App\Filament\Resources\LogPermitServices;

use App\Filament\Resources\LogPermitServices\Pages\CreateLogPermitService;
use App\Filament\Resources\LogPermitServices\Pages\EditLogPermitService;
use App\Filament\Resources\LogPermitServices\Pages\ListLogPermitServices;
use App\Filament\Resources\LogPermitServices\Schemas\LogPermitServiceForm;
use App\Filament\Resources\LogPermitServices\Tables\LogPermitServicesTable;
use App\Models\PermitService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LogPermitServiceResource extends Resource
{
    protected static ?string $model = PermitService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?string $recordTitleAttribute = 'Log Izin Pelayanan';
    protected static ?string $pluralModelLabel = 'Log Izin Pelayanan';
    protected static string | UnitEnum | null $navigationGroup = 'Log';
    protected static ?int $navigationSort = 4;

    // --- FITUR: HANYA LIHAT (READ-ONLY) ---
    public static function canCreate(): bool { return false; }
    public static function canEdit($record): bool { return false; }
    public static function canDelete($record): bool { return false; }

    public static function table(Table $table): Table
    {
        return LogPermitServicesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLogPermitServices::route('/'),
        ];
    }
}
