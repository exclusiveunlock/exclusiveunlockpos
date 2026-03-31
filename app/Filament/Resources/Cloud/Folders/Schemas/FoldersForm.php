<?php

namespace App\Filament\Resources\Cloud\Folders\Schemas;

use App\Models\Folder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class FoldersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make()
                    ->schema([
                        // Nombre
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                self::recalculatePath($get, $set, $state);
                            }),


                        Grid::make(12)->schema([

                            FileUpload::make('icon_path')
                                ->label('Ícono de carpeta')
                                ->image()
                                ->directory('folder-icons')
                                ->imageEditor()
                                ->imageCropAspectRatio('1:1')
                                ->imageResizeTargetWidth(200)
                                ->imageResizeTargetHeight(200)
                                ->helperText('Opcional — si no subes ninguno se usará el ícono por defecto')
                                ->columnSpan(3),

                            Select::make('parent_id')
                                ->label('Carpeta padre')
                                ->placeholder('Sin padre (carpeta raíz)')
                                ->options(
                                    fn() => Folder::when(
                                        request()->route('record'),
                                        fn($q) => $q->where('id', '!=', request()->route('record'))
                                    )
                                        ->orderBy('full_path')
                                        ->pluck('full_path', 'id')
                                )
                                ->searchable()
                                ->live()
                                ->afterStateUpdated(function (Get $get, Set $set, ?int $state) {
                                    $set('depth', $state ? (Folder::find($state)?->depth + 1 ?? 0) : 0);
                                    self::recalculatePath($get, $set, $get('name'));
                                })
                                ->helperText('Déjalo vacío para crear una carpeta raíz')
                                ->columnSpan(9),
                        ]),

                        // Depth + full_path (solo lectura)
                        Grid::make(12)->schema([

                            TextInput::make('depth')
                                ->label('Profundidad')
                                ->numeric()
                                ->default(0)
                                ->disabled()
                                ->dehydrated(true)
                                ->helperText('Calculado automáticamente')
                                ->columnSpan(3),

                            TextInput::make('full_path')
                                ->label('Ruta completa')
                                ->disabled()
                                ->dehydrated(true)
                                ->helperText('Se genera a partir del nombre y la carpeta padre')
                                ->columnSpan(9),
                        ]),
                    ]),
            ]);
    }

    private static function recalculatePath(Get $get, Set $set, ?string $name): void
    {
        if (!$name) return;

        $parentId = $get('parent_id');

        if ($parentId) {
            $parent     = Folder::find($parentId);
            $parentPath = $parent?->full_path ?? $parent?->name ?? '';
            $set('full_path', $parentPath . ' / ' . $name);
        } else {
            $set('full_path', $name);
        }
    }
}
