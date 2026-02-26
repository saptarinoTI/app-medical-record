<?php

namespace App\Filament\Resources\LogPermitServices\Pages;

use App\Filament\Resources\LogPermitServices\LogPermitServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLogPermitServices extends ListRecords
{
    protected static string $resource = LogPermitServiceResource::class;

    // public function getTabs(): array
    // {
    //     return [
    //         'Semua' => Tab::make(),
    //         'Kadaluarsa' => Tab::make()
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'expired')),
    //         'Dibatalkan' => Tab::make()
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'cancelled')),
    //     ];
    // }
}
