<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Pages\Resource\BaseList;
use App\Filament\Resources\Services\ServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServices extends BaseList
{
    protected static string $resource = ServiceResource::class;
}
