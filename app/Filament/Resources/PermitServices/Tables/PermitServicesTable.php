<?php

namespace App\Filament\Resources\PermitServices\Tables;

use App\Models\PermitService;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PermitServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn($query) =>
                $query->where('status', 'active')
            )
            ->columns([
                TextColumn::make('service.name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable()
                    // Menampilkan alasan di bawah nama dokter
                    ->description(fn(PermitService $record): string => $record->reason ?? '-')
                    // Mengaktifkan fitur bungkus teks agar tidak terpotong (truncate)
                    ->wrap(),
                TextColumn::make('permit_start')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('permit_end')
                    ->label('Selesai')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('back')
                    ->label('Praktek')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'expired' => 'warning',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'active' => 'Aktif',
                        'expired' => 'Kedaluwarsa',
                        'cancelled' => 'Dibatalkan',
                    }),
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
                // SelectFilter::make('status')
                //     ->label('Filter Status')
                //     ->options([
                //         'active' => 'Aktif',
                //         'expired' => 'Kedaluwarsa',
                //         'cancelled' => 'Dibatalkan',
                //     ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => auth()->user()->isSuperAdmin()),
                ]),
            ]);
    }
}
