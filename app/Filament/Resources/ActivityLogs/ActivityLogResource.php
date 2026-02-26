<?php

namespace App\Filament\Resources\ActivityLogs;

use App\Filament\Resources\ActivityLogs\Pages\CreateActivityLog;
use App\Filament\Resources\ActivityLogs\Pages\EditActivityLog;
use App\Filament\Resources\ActivityLogs\Pages\ListActivityLogs;
use App\Filament\Resources\ActivityLogs\Schemas\ActivityLogForm;
use App\Filament\Resources\ActivityLogs\Tables\ActivityLogsTable;
use App\Models\ActivityLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static ?string $recordTitleAttribute = 'Log Izin Pelayanan';
    protected static ?string $modelLabel = 'Log Izin Pelayanan';
    protected static ?string $pluralModelLabel = 'Log Izin Pelayanan';
    protected static string | UnitEnum | null $navigationGroup = 'Log';
    protected static ?int $navigationSort = 5;

    public static function table(Table $table): Table
    {
        return ActivityLogsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityLogs::route('/'),
        ];
    }


    // ❌ Disable create
    public static function canCreate(): bool
    {
        return false;
    }

    // ❌ Disable edit
    public static function canEdit($record): bool
    {
        return false;
    }

    // ❌ Disable delete
    public static function canDelete($record): bool
    {
        return false;
    }

    // 🔒 Optional: hanya superadmin
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->isSuperAdmin();
    }
}
