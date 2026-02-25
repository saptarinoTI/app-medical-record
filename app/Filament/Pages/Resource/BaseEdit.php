<?php

namespace App\Filament\Pages\Resource;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class BaseEdit extends EditRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Data'),
        ];
    }
}