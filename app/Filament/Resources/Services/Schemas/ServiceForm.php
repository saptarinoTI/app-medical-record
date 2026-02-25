<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('specialist')
                    ->label('Poli')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Sedang Aktif')
                    ->required()
                    ->default(true),
            ]);
    }
}
