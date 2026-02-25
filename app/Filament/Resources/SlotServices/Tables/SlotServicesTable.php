<?php

namespace App\Filament\Resources\SlotServices\Tables;

use App\Models\SlotService;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SlotServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service.name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable()
                    // Menampilkan alasan di bawah nama dokter
                    ->description(fn(SlotService $record): string => $record->information ?? '-')
                    // Mengaktifkan fitur bungkus teks agar tidak terpotong (truncate)
                    ->wrap(),
                TextColumn::make('days')
                     ->label('Hari')
                    ->badge()
                    ->separator(',')
                    ->wrap(),
                 TextColumn::make('time_range')
                    ->label('Jam Praktik')
                    ->state(fn ($record) => "$record->start_time - $record->end_time"),
                TextColumn::make('quota')
                   ->label('Kuota')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
