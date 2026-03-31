<?php

namespace App\Filament\Resources\Cloud\PaymentGateways\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentGatewaysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('filament/admin/payment_gateway_resource.id'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('filament/admin/payment_gateway_resource.name'))
                    ->searchable(),
                TextColumn::make('slug')
                    ->label(__('filament/admin/payment_gateway_resource.slug'))
                    ->searchable(),
                TextColumn::make('type')
                    ->label(__('filament/admin/payment_gateway_resource.type'))
                    ->searchable(),
                TextColumn::make('min_amount')
                    ->label(__('filament/admin/payment_gateway_resource.min_amount'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_amount')
                    ->label(__('filament/admin/payment_gateway_resource.max_amount'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('exchange_rate')
                    ->label(__('filament/admin/payment_gateway_resource.exchange_rate'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('logo')
                    ->label(__('filament/admin/payment_gateway_resource.logo'))
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label(__('filament/admin/payment_gateway_resource.is_active'))
                    ->boolean(),
                IconColumn::make('is_sandbox')
                    ->label(__('filament/admin/payment_gateway_resource.is_sandbox'))
                    ->boolean(),
                TextColumn::make('currency_id')
                    ->label(__('filament/admin/payment_gateway_resource.currency_id'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('filament/admin/payment_gateway_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/admin/payment_gateway_resource.updated_at'))
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
