<?php

namespace App\Filament\Resources\LogPermitServices\Pages;

use App\Filament\Resources\LogPermitServices\LogPermitServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLogPermitServices extends ListRecords
{
    protected static string $resource = LogPermitServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
