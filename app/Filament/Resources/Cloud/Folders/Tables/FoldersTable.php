<?php

namespace App\Filament\Resources\Cloud\Folders\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

use Filament\Support\Enums\FontWeight;
use Filament\Notifications\Notification;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;

class FoldersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon_path')
                    ->height(40)
                    ->circular()
                    ->defaultImageUrl(url('/images/gsmxstore/folder.png')),

                TextColumn::make('name')
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->description(fn ($record) => $record->full_path),

                TextColumn::make('depth')
                    ->label('Level')
                    ->sortable(),

                TextColumn::make('description')
                    ->limit(50)
                    ->toggleable(),

                TextColumn::make('files_count')
                    ->label('Files')
                    ->counts('firmware')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('created_at')->dateTime()->sortable(),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])

            ->headerActions([
                Action::make('newFolder')
                    ->label('New Folder')
                    ->icon('heroicon-o-folder-plus')
                    ->modalHeading('Create Folder')
                    ->form([
                        Section::make('Folder Info')->schema([
                            Select::make('parent_id')
                                ->label('Parent Folder')
                                ->placeholder('Root')
                                ->options(fn () => self::getFolderTree()),

                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),

                            Textarea::make('description')
                                ->rows(3),

                            FileUpload::make('icon_path')
                                ->image()
                                ->directory('folder-icons')
                                ->visibility('public'),

                            Checkbox::make('is_active')
                                ->default(true),
                        ]),
                    ])
                    ->action(function (array $data) {
                        try {
                            $depth = 0;
                            $fullPath = $data['name'];

                            if (!empty($data['parent_id'])) {
                                $parent = \App\Models\Folder::find($data['parent_id']);
                                if ($parent) {
                                    $depth = $parent->depth + 1;
                                    $fullPath = $parent->full_path . '/' . $data['name'];
                                }
                            }

                            \App\Models\Folder::create([
                                'parent_id' => $data['parent_id'] ?? null,
                                'name' => $data['name'],
                                'description' => $data['description'] ?? null,
                                'icon_path' => $data['icon_path'] ?? null,
                                'is_active' => $data['is_active'] ?? true,
                                'depth' => $depth,
                                'full_path' => $fullPath,
                            ]);

                            Notification::make()
                                ->success()
                                ->title('Folder created')
                                ->send();

                        } catch (\Exception $e) {
                            Notification::make()
                                ->danger()
                                ->title($e->getMessage())
                                ->send();
                        }
                    }),

                Action::make('quickFolder')
                    ->label('Quick Folder')
                    ->icon('heroicon-o-folder')
                    ->form([
                        TextInput::make('name')->required(),
                        Checkbox::make('is_active')->default(true),
                    ])
                    ->action(function (array $data) {
                        \App\Models\Folder::create([
                            'name' => $data['name'],
                            'is_active' => $data['is_active'] ?? true,
                            'depth' => 0,
                            'full_path' => $data['name'],
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Created')
                            ->send();
                    }),
            ])

            ->recordActions([
                Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->form([
                        Section::make()->schema([
                            Select::make('parent_id')
                                ->options(fn () => self::getFolderTree()),

                            TextInput::make('name')->required(),

                            Textarea::make('description'),

                            FileUpload::make('icon_path')
                                ->image()
                                ->directory('folder-icons'),

                            Checkbox::make('is_active'),

                            Hidden::make('id'),
                        ]),
                    ])
                    ->fillForm(fn ($record) => $record->toArray())
                    ->action(function ($record, $data) {

                        $depth = 0;
                        $fullPath = $data['name'];

                        if (!empty($data['parent_id'])) {
                            $parent = \App\Models\Folder::find($data['parent_id']);
                            if ($parent) {
                                $depth = $parent->depth + 1;
                                $fullPath = $parent->full_path . '/' . $data['name'];
                            }
                        }

                        $record->update([
                            'parent_id' => $data['parent_id'],
                            'name' => $data['name'],
                            'description' => $data['description'],
                            'icon_path' => $data['icon_path'],
                            'is_active' => $data['is_active'],
                            'depth' => $depth,
                            'full_path' => $fullPath,
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Updated')
                            ->send();
                    }),

                EditAction::make(),

                Action::make('view')
                    ->icon('heroicon-o-eye')
                    ->form([
                        TextInput::make('name')->disabled(),
                        TextInput::make('full_path')->disabled(),
                        TextInput::make('depth')->disabled(),
                        Textarea::make('description')->disabled(),
                        Checkbox::make('is_active')->disabled(),
                    ])
                    ->fillForm(fn ($record) => $record->toArray()),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                    Action::make('toggleActive')
                        ->label('Set Active')
                        ->form([
                            Select::make('status')
                                ->options([
                                    1 => 'Active',
                                    0 => 'Inactive',
                                ])
                                ->required(),
                        ])
                        ->action(function ($records, $data) {
                            foreach ($records as $record) {
                                $record->update([
                                    'is_active' => $data['status'],
                                ]);
                            }

                            Notification::make()
                                ->success()
                                ->title('Updated')
                                ->send();
                        }),
                ]),
            ])

            ->defaultSort('id', 'desc');
    }

    private static function getFolderTree(): array
    {
        return \App\Models\Folder::orderBy('depth')
            ->get()
            ->mapWithKeys(fn ($f) => [
                $f->id => str_repeat('— ', $f->depth) . $f->name
            ])
            ->toArray();
    }
}