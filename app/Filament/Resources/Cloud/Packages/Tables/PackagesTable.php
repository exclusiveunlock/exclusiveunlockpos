<?php

namespace App\Filament\Resources\Cloud\Packages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PackagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                    ->label('Paquete')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // Tipo: badge con color
                TextColumn::make('package_type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'free' => 'success',
                        'paid' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state) => match ($state) {
                        'free' => 'Gratuito',
                        'paid' => 'De pago',
                        default => $state,
                    })
                    ->sortable(),

                // Precio con moneda
                TextColumn::make('price')
                    ->label('Precio')
                    ->money(fn($record) => $record->currency?->code ?? 'USD')
                    ->sortable()
                    ->placeholder('—'),

                // Duración
                TextColumn::make('duration_in_months')
                    ->label('Duración')
                    ->formatStateUsing(fn($state) => $state == 1 ? '1 mes' : "{$state} meses")
                    ->sortable(),

                // Moneda
                TextColumn::make('currency.name')
                    ->label('Moneda')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Bandwidth resumido: "500 GB / día: 17 GB"
                TextColumn::make('bandwidth')
                    ->label('Bandwidth')
                    ->formatStateUsing(
                        fn($state, $record) =>
                            number_format($record->bandwidth) . ' ' . $record->bandwidth_unit
                    )
                    ->description(
                        fn($record) =>
                            'Diario: ' . number_format($record->daily_bandwidth) . ' ' . $record->bandwidth_unit .
                            ' · Total: ' . number_format($record->total_bandwidth) . ' ' . $record->bandwidth_unit
                    )
                    ->sortable(),

                // Archivos resumidos
                TextColumn::make('files')
                    ->label('Archivos')
                    ->formatStateUsing(
                        fn($state, $record) => number_format($record->files) . ' archivos'
                    )
                    ->description(
                        fn($record) =>
                            'Diario: ' . number_format($record->daily_files) .
                            ' · Total: ' . number_format($record->total_files)
                    )
                    ->sortable(),

                // Dispositivos
                TextColumn::make('device_limit')
                    ->label('Dispositivos')
                    ->formatStateUsing(fn($state) => $state == 0 ? 'Ilimitado' : $state)
                    ->sortable(),

                // Acceso a archivos con contraseña
                IconColumn::make('can_access_password_files')
                    ->label('Con contraseña')
                    ->boolean()
                    ->trueIcon('heroicon-o-lock-open')
                    ->falseIcon('heroicon-o-lock-closed')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('package_type')
                    ->label('Tipo')
                    ->options([
                        'free' => 'Gratuito',
                        'paid' => 'De pago',
                    ]),

                SelectFilter::make('currency_id')
                    ->label('Moneda')
                    ->relationship('currency', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}