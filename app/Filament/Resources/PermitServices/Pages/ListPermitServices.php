<?php

namespace App\Filament\Resources\PermitServices\Pages;

use App\Filament\Pages\Resource\BaseList;
use App\Filament\Resources\PermitServices\PermitServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPermitServices extends BaseList
{
    protected static string $resource = PermitServiceResource::class;
}
