<?php

namespace App\Filament\Resources\SlotServices\Pages;

use App\Filament\Pages\Resource\BaseEdit;
use App\Filament\Resources\SlotServices\SlotServiceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSlotService extends BaseEdit
{
    protected static string $resource = SlotServiceResource::class;
}
