<?php

namespace App\Filament\Resources\Cloud\Folders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\FontWeight;

class FoldersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([


                ImageColumn::make('icon_path')
                    ->imageHeight(40)
                 
                    ->circular()
                    ->stacked()
                    ->defaultImageUrl(url('/images/gsmxstore/folder.png')),

                // 📁 Nombre + path
                TextColumn::make('name')
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->description(fn($record) => $record->full_path),

                // 📂 Padre
                TextColumn::make('parent.name')
                    ->label('Parent')
                    ->badge()
                    ->color('gray'),

                // 📊 Nivel
                TextColumn::make('depth')
                    ->label('Level')
                    ->sortable(),

                // 📅 Fechas
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->defaultSort('id', 'desc');
    }
}
