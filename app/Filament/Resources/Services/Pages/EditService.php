<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Pages\Resource\BaseEdit;
use App\Filament\Resources\Services\ServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditService extends BaseEdit
{
    protected static string $resource = ServiceResource::class;
}
