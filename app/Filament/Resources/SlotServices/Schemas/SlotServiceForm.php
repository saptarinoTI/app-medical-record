<?php

namespace App\Filament\Resources\SlotServices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class SlotServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_id')
                    ->label('Nama Lengkap')
                    ->relationship(
                        name: 'service',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->where('is_active', true)
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('days')
                    ->label('Hari Praktik')
                    ->multiple() // Memungkinkan pilih banyak hari
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                        'Minggu' => 'Minggu',
                    ])
                    ->required(),
                TimePicker::make('start_time')
                    ->label('Jam Mulai')
                    ->required(),
                TimePicker::make('end_time')
                    ->label('Jam Selesai')
                    ->required(),
                TextInput::make('quota')
                    ->label('Kuota Pasien')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Textarea::make('information')
                    ->label('Keterangan Tambahan')
                    ->columnSpanFull(),
            ]);
    }
}
