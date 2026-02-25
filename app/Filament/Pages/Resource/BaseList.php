<?php

namespace App\Filament\Pages\Resource;

use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class BaseList extends ListRecords
{
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Data'),
        ];
    }
}