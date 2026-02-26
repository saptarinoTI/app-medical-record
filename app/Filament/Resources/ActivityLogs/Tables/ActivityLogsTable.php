<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model')
                    ->label('Model')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('model_id')
                    ->label('Data')
                    ->formatStateUsing(function ($state, $record) {

                        if ($record->model === \App\Models\PermitService::class) {

                            $permit = \App\Models\PermitService::find($state);

                            return $permit?->service?->name ?? 'Data tidak ditemukan';
                        }

                        return $state;
                    })
                    ->sortable(),
                TextColumn::make('action')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('user.name')
                    ->label('User')
                    ->default('System')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
