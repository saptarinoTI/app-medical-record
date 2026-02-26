<?php

namespace App\Filament\Resources\LogPermitServices\Tables;

use App\Models\PermitService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LogPermitServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn($query) =>
                $query->where('status', '!=', 'active')
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
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'active' => 'success',
                        'expired' => 'warning',
                        'cancelled' => 'danger',
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        // 'active' => 'Aktif',
                        'expired' => 'Kedaluwarsa',
                        'cancelled' => 'Dibatalkan',
                    ]),
                Filter::make('permit_date')
                    ->label('Filter Tanggal Izin')
                    ->form([
                        DatePicker::make('permit_start')
                            ->label('Mulai Dari')
                            ->native(false),

                        DatePicker::make('permit_end')
                            ->label('Sampai Tanggal')
                            ->native(false),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['permit_start'],
                                fn($query, $date) =>
                                $query->whereDate('permit_start', '>=', $date)
                            )
                            ->when(
                                $data['permit_end'],
                                fn($query, $date) =>
                                $query->whereDate('permit_end', '<=', $date)
                            );
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn($record) => $record->status !== 'expired'),
            ])
            ->toolbarActions([
                Action::make('cetak_pdf')
                    ->label('Cetak PDF')
                    ->icon('heroicon-o-printer')
                    ->color('gray')
                    ->url(function ($livewire) {
                        return route('log-permit-services.print', [
                            'filters' => $livewire->tableFilters,
                        ]);
                    })
                    ->openUrlInNewTab(),
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => auth()->user()->isSuperAdmin()),
                ]),
            ]);
    }
}
