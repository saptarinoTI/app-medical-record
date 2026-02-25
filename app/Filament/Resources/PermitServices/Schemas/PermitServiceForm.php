<?php

namespace App\Filament\Resources\PermitServices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PermitServiceForm
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
                    ->live()
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options(['active' => 'Active', 'expired' => 'Expired', 'cancelled' => 'Cancelled'])
                    ->default('active')
                    ->required(),
                DatePicker::make('permit_start')
                    ->label('Mulai Izin')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->native(false) // Opsional: agar tampilan kalender lebih modern
                    ->live(), // Sangat Penting: agar perubahan tanggal langsung terbaca oleh field lain
                DatePicker::make('permit_end')
                    ->label('Selesai Izin')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->live()
                    // Mencegah user memilih tanggal sebelum permit_start di UI kalender
                    ->minDate(fn(Get $get) => $get('permit_start'))
                    // Validasi tambahan saat form di-submit
                    ->afterOrEqual('permit_start')
                    ->validationMessages([
                        'after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
                    ]),
                DatePicker::make('back')
                    ->label('Mulai Praktek')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->live()
                    // Mencegah user memilih tanggal sebelum leave_start di UI kalender
                    ->minDate(fn(Get $get) => $get('permit_end'))
                    // Validasi tambahan saat form di-submit
                    ->afterOrEqual('permit_end')
                    ->validationMessages([
                        'after_or_equal' => 'Tanggal mulai praktek tidak boleh sebelum tanggal selesai.',
                    ]),
                Textarea::make('reason')
                    ->label('Alasan Izin')
                    ->columnSpanFull(),
            ]);
    }
}
