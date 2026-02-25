<?php

namespace App\Filament\Resources\PermitServices\Pages;

use App\Filament\Pages\Resource\BaseEdit;
use App\Filament\Resources\PermitServices\PermitServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPermitService extends BaseEdit
{
    protected static string $resource = PermitServiceResource::class;
}
