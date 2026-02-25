<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Pages\Resource\BaseCreate;
use App\Filament\Resources\Services\ServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends BaseCreate
{
    protected static string $resource = ServiceResource::class;
}
