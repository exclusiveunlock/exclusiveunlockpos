<?php

namespace App\Filament\Resources\Cloud\Firmware\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class FirmwareTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('filament/admin/firmware_resource.id'))
                    ->sortable(),

                TextColumn::make('name')
                    ->label(__('filament/admin/firmware_resource.name'))
                    ->searchable()
                    ->limit(30),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'free' => 'success',
                        'paid' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('price')
                    ->label(__('filament/admin/firmware_resource.price'))
                    ->money('USD', true)
                    ->visible(fn ($livewire, $record) => $record?->type === 'paid'),

                TextColumn::make('formatted_size')
                    ->label(__('filament/admin/firmware_resource.formatted_size'))
                    ->sortable(),

                TextColumn::make('upload_type')
                    ->label('Upload')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'direct' => 'primary',
                        'url' => 'info',
                        'ftp' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('folder.name')
                    ->label(__('filament/admin/firmware_resource.folder.name'))
                    ->searchable()
                    ->badge(),

                TextColumn::make('downloads_count')
                    ->label(__('filament/admin/firmware_resource.downloads_count'))
                    ->sortable()
                    ->numeric(),

                TextColumn::make('views_count')
                    ->label(__('filament/admin/firmware_resource.views_count'))
                    ->sortable()
                    ->numeric(),

                TextColumn::make('created_at')
                    ->label(__('filament/admin/firmware_resource.created_at'))
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}