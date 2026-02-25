<?php

namespace App\Filament\Resources\PermitServices\Pages;

use App\Filament\Pages\Resource\BaseCreate;
use App\Filament\Resources\PermitServices\PermitServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePermitService extends BaseCreate
{
    protected static string $resource = PermitServiceResource::class;
}
