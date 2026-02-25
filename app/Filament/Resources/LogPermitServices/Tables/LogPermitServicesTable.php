<?php

namespace App\Filament\Resources\LogPermitServices\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
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
                TextColumn::make('created_at')->label('Waktu')->date()->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'active' => 'success',
                        'expired' => 'warning',
                        'cancelled' => 'danger',
                    }),

                TextColumn::make('description')->wrap(),
                TextColumn::make('action')->color(fn($state) => match ($state) {
                    'create' => 'success',
                    'update' => 'warning',
                    'delete' => 'danger',
                }),
                TextColumn::make('user.name')->label('Oleh User'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn($record) => $record->status !== 'expired'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
