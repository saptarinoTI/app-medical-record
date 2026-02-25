<?php

namespace App\Filament\Pages\Resource;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class BaseCreate extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}