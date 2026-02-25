<?php

namespace App\Filament\Resources\SlotServices\Pages;

use App\Filament\Pages\Resource\BaseList;
use App\Filament\Resources\SlotServices\SlotServiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSlotServices extends BaseList
{
    protected static string $resource = SlotServiceResource::class;
}
