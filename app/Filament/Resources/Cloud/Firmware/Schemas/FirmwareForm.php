<?php

namespace App\Filament\Resources\Cloud\Firmware\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

use App\Models\Folder;
use Illuminate\Support\Str;

class FirmwareForm
{
   public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                // 🔹 HEADER
                Grid::make(12)->schema([
                    Forms\Components\TextInput::make('name')
                    ->label(__('filament/admin/firmware_resource.name'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                            if (($get('slug') ?? '') === Str::slug($old)) {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->columnSpan(6),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique('firmware', 'slug', ignoreRecord: true)
                        ->helperText('URL amigable')
                        ->prefixIcon('heroicon-m-link')
                        ->columnSpan(4),

                    // ✅ Icono cuadrado (sin avatar/circleCropper)
                    Forms\Components\FileUpload::make('icon_path')
                        ->image()
                        ->directory('firmware-icons')
                        ->imageEditor()
                        ->imageCropAspectRatio('1:1')
                        ->imageResizeTargetWidth(200)
                        ->imageResizeTargetHeight(200)
                        ->label(__('filament/admin/firmware_resource.icon_path'))
                        ->columnSpan(2),
                ]),

                // 🔹 DESCRIPCIÓN
                Forms\Components\RichEditor::make('description')
                    ->label(__('filament/admin/firmware_resource.description'))
                    ->toolbarButtons([
                        'bold', 'italic', 'underline',
                        'bulletList', 'orderedList', 'link', 'codeBlock',
                    ])
                    ->columnSpanFull()
                    ->extraAttributes(['class' => 'min-h-[250px]']),

                // 🔹 DETAILS
                Section::make('Details')
                    ->schema([

                        // Fila: size, unit, formatted, type, price
                        Grid::make(12)->schema([

                            Forms\Components\TextInput::make('size')
                    ->label(__('filament/admin/firmware_resource.size'))
                                ->required()
                                ->numeric()
                                ->step(0.01)
                                ->live()
                                ->afterStateUpdated(function (Get $get, Set $set) {
                                    $set('formatted_size', self::formatSize($get('size'), $get('size_unit')));
                                })
                                ->columnSpan(3),

                            Forms\Components\Select::make('size_unit')
                    ->label(__('filament/admin/firmware_resource.size_unit'))
                                ->options(['KB' => __('filament/admin/firmware_resource.size_unit.k_b'), 'MB' => __('filament/admin/firmware_resource.size_unit.m_b'), 'GB' => __('filament/admin/firmware_resource.size_unit.g_b'), 'TB' => __('filament/admin/firmware_resource.size_unit.t_b')])
                                ->default(__('filament/admin/firmware_resource.size_unit_default'))
                                ->required()
                                ->live()
                                ->afterStateUpdated(function (Get $get, Set $set) {
                                    $set('formatted_size', self::formatSize($get('size'), $get('size_unit')));
                                })
                                ->columnSpan(2),

                            Forms\Components\TextInput::make('formatted_size')
                                ->label(__('filament/admin/firmware_resource.formatted_size'))
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(3),

                            Forms\Components\Select::make('type')
                    ->label(__('filament/admin/firmware_resource.type'))
                                ->options(['free' => __('filament/admin/firmware_resource.type.free'), 'featured' => __('filament/admin/firmware_resource.type.featured'), 'paid' => __('filament/admin/firmware_resource.type.paid')])
                                ->default(__('filament/admin/firmware_resource.type_default'))
                                ->live()
                                ->required()
                                ->columnSpan(2),

                            Forms\Components\TextInput::make('price')
                    ->label(__('filament/admin/firmware_resource.price'))
                                ->numeric()
                                ->prefix('$')
                                ->hidden(fn(Get $get) => $get('type') !== 'paid')
                                ->required(fn(Get $get) => $get('type') === 'paid')
                                ->step(0.01)
                                ->minValue(0)
                                ->columnSpan(2),
                        ]),

                        // 🔹 CARPETA + SUBCARPETA
                        Grid::make(12)->schema([

                            Forms\Components\Select::make('folder_id')
                                ->label(__('filament/admin/firmware_resource.folder_id'))
                                ->options(
                                    fn() => Folder::whereNull('parent_id')
                                        ->orderBy('name')
                                        ->pluck('name', 'id')
                                )
                                ->searchable()
                                ->live()
                                ->afterStateUpdated(fn(Set $set) => $set('sub_folder_id', null))
                                ->columnSpan(6),

                            Forms\Components\Select::make('sub_folder_id')
                                ->label(__('filament/admin/firmware_resource.sub_folder_id'))
                                ->options(function (Get $get) {
                                    $parentId = $get('folder_id');
                                    if (!$parentId) return [];

                                    return Folder::where('parent_id', $parentId)
                                        ->orderBy('name')
                                        ->pluck('name', 'id');
                                })
                                ->searchable()
                                ->placeholder('Selecciona una subcarpeta...')
                                ->hidden(function (Get $get) {
                                    $parentId = $get('folder_id');
                                    if (!$parentId) return true;

                                    return Folder::where('parent_id', $parentId)->doesntExist();
                                })
                                ->columnSpan(6),
                        ]),

                        // ✅ Servidor + Método de subida lado a lado
                        Grid::make(12)->schema([

                            Forms\Components\Select::make('file_server_id')
                                ->relationship('fileServer', 'name')
                                ->searchable()
                                ->preload()
                                ->label(__('filament/admin/firmware_resource.file_server_id'))
                                ->columnSpan(6),

                            Forms\Components\Select::make('upload_type')
                                ->label(__('filament/admin/firmware_resource.upload_type'))
                                ->options(['direct' => __('filament/admin/firmware_resource.upload_type.direct'), 'url' => __('filament/admin/firmware_resource.upload_type.url'), 'ftp' => __('filament/admin/firmware_resource.upload_type.ftp')])
                                ->default('direct')
                                ->required()
                                ->live()
                                ->columnSpan(6),

                        ]),

                        // Password
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->maxLength(255)
                            ->revealable(),

                        // ✅ Condicional: archivo directo
                        Forms\Components\FileUpload::make('attachment')
                            ->label(__('filament/admin/firmware_resource.attachment'))
                            ->disk('public')
                            ->directory('uploads/' . now()->format('Y/m/d'))
                            ->visibility('private')
                            ->maxSize(1024 * 1024)
                            ->hidden(fn(Get $get) => $get('upload_type') !== 'direct')
                            ->required(fn(Get $get) => $get('upload_type') === 'direct')
                            ->afterStateUpdated(function (Set $set) {
                                $set('url', null);
                                $set('ftp_host', null);
                                $set('ftp_username', null);
                                $set('ftp_password', null);
                                $set('ftp_port', null);
                                $set('ftp_path', null);
                            })
                            ->columnSpanFull(),

                        // ✅ Condicional: URL externa
                        Forms\Components\TextInput::make('url')
                            ->label(__('filament/admin/firmware_resource.url'))
                            ->url()
                            ->maxLength(500)
                            ->hidden(fn(Get $get) => $get('upload_type') !== 'url')
                            ->required(fn(Get $get) => $get('upload_type') === 'url')
                            ->afterStateUpdated(function (Set $set) {
                                $set('attachment', null);
                            })
                            ->columnSpanFull(),

                        // ✅ Condicional: FTP
                        Fieldset::make('Configuración FTP')
                            ->schema([
                                Grid::make(12)->schema([

                                    Forms\Components\TextInput::make('ftp_host')
                                        ->label(__('filament/admin/firmware_resource.ftp_host'))
                                        ->columnSpan(5),

                                    Forms\Components\TextInput::make('ftp_port')
                                        ->label(__('filament/admin/firmware_resource.ftp_port'))
                                        ->numeric()
                                        ->default(21)
                                        ->columnSpan(2),

                                    Forms\Components\Select::make('ftp_mode')
                                        ->label(__('filament/admin/firmware_resource.ftp_mode'))
                                        ->options(['auto' => __('filament/admin/firmware_resource.ftp_mode.auto'), 'active' => __('filament/admin/firmware_resource.ftp_mode.active'), 'passive' => __('filament/admin/firmware_resource.ftp_mode.passive')])
                                        ->columnSpan(5),

                                    Forms\Components\TextInput::make('ftp_username')
                                        ->label(__('filament/admin/firmware_resource.ftp_username'))
                                        ->columnSpan(6),

                                    Forms\Components\TextInput::make('ftp_password')
                                        ->label(__('filament/admin/firmware_resource.ftp_password'))
                                        ->password()
                                        ->columnSpan(6),

                                    Forms\Components\TextInput::make('ftp_path')
                                        ->label(__('filament/admin/firmware_resource.ftp_path'))
                                        ->columnSpan(12),
                                ]),
                            ])
                            ->hidden(fn(Get $get) => $get('upload_type') !== 'ftp'),

                    ]),

                // 🔹 TAGS + META
                Grid::make(12)->schema([
                    Forms\Components\Select::make('tags')
                        ->relationship('tags', 'name')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->columnSpan(6),

                    Forms\Components\KeyValue::make('metadata')
                        ->label(__('filament/admin/firmware_resource.metadata'))
                        ->columnSpan(6),
                ]),

                // 🔹 STATS
                Section::make('Estadísticas')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Grid::make(12)->schema([
                            Forms\Components\TextInput::make('downloads_count')
                    ->label(__('filament/admin/firmware_resource.downloads_count'))
                                ->numeric()
                                ->disabled()
                                ->columnSpan(4),

                            Forms\Components\TextInput::make('views_count')
                    ->label(__('filament/admin/firmware_resource.views_count'))
                                ->numeric()
                                ->disabled()
                                ->columnSpan(4),

                            Forms\Components\TextInput::make('rating')
                    ->label(__('filament/admin/firmware_resource.rating'))
                                ->numeric()
                                ->disabled()
                                ->columnSpan(4),
                        ]),
                    ]),
            ]);
    }

    private static function formatSize(?float $size, ?string $unit): string
    {
        if (!$size) return 'N/A';

        $units    = ['KB' => 1, 'MB' => 2, 'GB' => 3, 'TB' => 4];
        $baseUnit = $units[$unit] ?? 2;
        $bytes    = $size * pow(1024, $baseUnit);

        $formattedUnits = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($formattedUnits) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $formattedUnits[$i];
    }
}
