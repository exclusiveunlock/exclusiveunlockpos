<?php

namespace App\Filament\Resources\Cloud\Firmware\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action; // ← IMPORTANTE: Cambiar a Tables\Actions
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use App\Services\TelegramService;
use Illuminate\Support\Str;

class FirmwareTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'free'     => 'success',
                        'paid'     => 'warning',
                        'featured' => 'primary',
                        default    => 'gray',
                    }),

                TextColumn::make('price')
                    ->label('Price')
                    ->money('USD', true),

                TextColumn::make('size')
                    ->label('Size')
                    ->formatStateUsing(fn ($record) => $record->size . ' ' . $record->size_unit)
                    ->sortable(),

                TextColumn::make('upload_type')
                    ->label('Upload')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'direct'   => 'primary',
                        'indirect' => 'info',
                        'dc_link'  => 'warning',
                        'upload'   => 'success',
                        'local'    => 'gray',
                        default    => 'gray',
                    }),

                TextColumn::make('folder.name')
                    ->label('Folder')
                    ->searchable()
                    ->badge(),

                TextColumn::make('downloads_count')
                    ->label('Downloads')
                    ->sortable()
                    ->numeric(),

                TextColumn::make('views_count')
                    ->label('Views')
                    ->sortable()
                    ->numeric(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->headerActions([
                Action::make('newFile') // ← Ahora usa el Tables\Actions\Action correcto
                    ->label('New File')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('New File')
                    ->modalWidth('2xl')
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tab::make('General')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([

                                        // ── Carpeta ──────────────────────────────
                                        Section::make('Location')
                                            ->schema([
                                                Select::make('folder_id')
                                                    ->label('Folder')
                                                    ->placeholder('Select a folder')
                                                    ->options(fn () => \App\Models\Folder::whereNull('parent_id')
                                                        ->orWhere('parent_id', 0)
                                                        ->pluck('name', 'id'))
                                                    ->reactive()
                                                    ->afterStateUpdated(fn (callable $set) => $set('subfolder_id', null))
                                                    ->required()
                                                    ->columnSpanFull(),

                                                Select::make('subfolder_id')
                                                    ->label('Subfolder (Optional)')
                                                    ->placeholder('Select a subfolder')
                                                    ->options(fn (callable $get) => \App\Models\Folder::where('parent_id', $get('folder_id'))->pluck('name', 'id'))
                                                    ->reactive()
                                                    ->columnSpanFull(),
                                            ]),

                                        // ── Nombre ───────────────────────────────
                                        TextInput::make('name')
                                            ->label('Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Title')
                                            ->columnSpanFull(),

                                        // ── Descripción ──────────────────────────
                                        TextInput::make('description')
                                            ->label('Description')
                                            ->maxLength(500)
                                            ->placeholder('Description')
                                            ->columnSpanFull(),

                                        // ── Contraseña ───────────────────────────
                                        TextInput::make('password')
                                            ->label('Password (optional)')
                                            ->password()
                                            ->revealable()
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        // ── Método de subida ─────────────────────
                                        Select::make('upload_type')
                                            ->label('Method')
                                            ->required()
                                            ->placeholder('Link Type')
                                            ->options([
                                                'direct'   => 'Direct URL',
                                                'indirect' => 'Indirect URL',
                                                'dc_link'  => 'DC Link',
                                                'upload'   => 'File Upload',
                                                'local'    => 'Local File',
                                            ])
                                            ->default('direct')
                                            ->reactive()
                                            ->columnSpanFull(),

                                        // direct → firmware.url
                                        TextInput::make('url')
                                            ->label('Direct URL')
                                            ->placeholder('https://...')
                                            ->maxLength(255)
                                            ->required()
                                            ->visible(fn (callable $get) => $get('upload_type') === 'direct')
                                            ->columnSpanFull(),

                                        // indirect → firmware.url + size
                                        TextInput::make('url')
                                            ->label('Indirect URL')
                                            ->placeholder('https://...')
                                            ->maxLength(255)
                                            ->required()
                                            ->visible(fn (callable $get) => $get('upload_type') === 'indirect')
                                            ->columnSpanFull(),

                                        // dc_link → firmware.ftp_host / ftp_username / ftp_password / ftp_path / file_server_id
                                        Group::make()->schema([
                                            Select::make('file_server_id')
                                                ->label('Server')
                                                ->placeholder('Download Server')
                                                ->options(fn () => \App\Models\FileServer::pluck('name', 'id'))
                                                ->required()
                                                ->searchable(),

                                            TextInput::make('ftp_host')
                                                ->label('FTP Host')
                                                ->maxLength(255),

                                            TextInput::make('ftp_username')
                                                ->label('FTP Username')
                                                ->maxLength(255),

                                            TextInput::make('ftp_password')
                                                ->label('FTP Password')
                                                ->password()
                                                ->revealable()
                                                ->maxLength(255),

                                            TextInput::make('ftp_path')
                                                ->label('FTP / DC Path')
                                                ->maxLength(255)
                                                ->required(),
                                        ])
                                        ->visible(fn (callable $get) => $get('upload_type') === 'dc_link')
                                        ->columnSpanFull(),

                                        // local → firmware.path
                                        TextInput::make('path')
                                            ->label('Local Path')
                                            ->placeholder('/storage/firmware/file.zip')
                                            ->maxLength(255)
                                            ->required()
                                            ->visible(fn (callable $get) => $get('upload_type') === 'local')
                                            ->columnSpanFull(),

                                        // upload → firmware.path (stored file)
                                        FileUpload::make('path')
                                            ->label('File Upload')
                                            ->required()
                                            ->visibility('public')
                                            ->directory('firmware-uploads')
                                            ->visible(fn (callable $get) => $get('upload_type') === 'upload')
                                            ->columnSpanFull(),

                                        // ── Tamaño ───────────────────────────────
                                        Grid::make(2)->schema([
                                            TextInput::make('size')
                                                ->label('File Size')
                                                ->numeric()
                                                ->minValue(0)
                                                ->step(0.01)
                                                ->default(0)
                                                ->required(),

                                            Select::make('size_unit')
                                                ->label('Unit')
                                                ->options([
                                                    'B'  => 'Byte',
                                                    'KB' => 'Kilobyte',
                                                    'MB' => 'Megabyte',
                                                    'GB' => 'Gigabyte',
                                                    'TB' => 'Terabyte',
                                                ])
                                                ->default('MB')
                                                ->required(),
                                        ]),

                                        // ── Tipo / Precio ─────────────────────────
                                        Checkbox::make('is_featured')
                                            ->label('Featured')
                                            ->reactive(),

                                        Checkbox::make('is_paid')
                                            ->label('Paid')
                                            ->reactive(),

                                        TextInput::make('price')
                                            ->label('Price')
                                            ->numeric()
                                            ->minValue(0.01)
                                            ->step(0.01)
                                            ->prefix('USD')
                                            ->required()
                                            ->visible(fn (callable $get) => $get('is_paid') === true),

                                    ])->columns(1),

                                Tab::make('View')
                                    ->icon('heroicon-o-pencil')
                                    ->schema([
                                        FileUpload::make('icon_path')
                                            ->label('Icon / Thumbnail')
                                            ->image()
                                            ->imagePreviewHeight('100')
                                            ->directory('firmware-icons')
                                            ->visibility('public')
                                            ->columnSpanFull(),

                                        RichEditor::make('body')
                                            ->label('Body')
                                            ->toolbarButtons([
                                                'bold', 'bulletList', 'italic', 'link',
                                                'orderedList', 'redo', 'strike', 'underline', 'undo',
                                            ])
                                            ->columnSpanFull()
                                            ->fileAttachmentsDirectory('attachments'),

                                        TagsInput::make('tags')
                                            ->label('Tags')
                                            ->placeholder('Add tags')
                                            ->separator(',')
                                            ->suggestions(['featured', 'popular', 'new', 'updated'])
                                            ->columnSpanFull(),
                                    ])->columns(1),
                            ])
                            ->activeTab(0)
                            ->columnSpanFull(),
                    ])
                    ->action(function (array $data): void {
                        try {
                            $finalFolderId = $data['subfolder_id'] ?? $data['folder_id'];

                            $firmware = \App\Models\Firmware::create([
                                'name'           => $data['name'],
                                'slug'           => Str::slug($data['name']),
                                'description'    => $data['description'] ?? null,
                                'password'       => $data['password'] ?? null,
                                'icon_path'      => $data['icon_path'] ?? null,
                                'folder_id'      => $finalFolderId,
                                'upload_type'    => $data['upload_type'],
                                'size'           => $data['size'] ?? 0,
                                'size_unit'      => $data['size_unit'] ?? 'MB',

                                'type' => ($data['is_featured'] ?? false)
                                    ? 'featured'
                                    : (($data['is_paid'] ?? false) ? 'paid' : 'free'),

                                'price' => ($data['is_paid'] ?? false) ? ($data['price'] ?? null) : null,

                                'url'            => in_array($data['upload_type'], ['direct', 'indirect'])
                                    ? ($data['url'] ?? null)
                                    : null,

                                'path'           => in_array($data['upload_type'], ['upload', 'local'])
                                    ? ($data['path'] ?? null)
                                    : null,

                                'file_server_id' => $data['file_server_id'] ?? null,
                                'ftp_host'       => $data['ftp_host'] ?? null,
                                'ftp_username'   => $data['ftp_username'] ?? null,
                                'ftp_password'   => $data['ftp_password'] ?? null,
                                'ftp_path'       => $data['ftp_path'] ?? null,
                            ]);

                            $folderName = optional($firmware->folder)->name ?? 'N/A';
                            $type       = strtoupper($firmware->type);
                            $viewUrl    = url('firmware/' . $firmware->name);

                            app(TelegramService::class)->send(
                                "📢 *New Firmware Update*\n\n"
                                . "✅ *Name:* {$firmware->name}\n"
                                . "📁 *Folder:* {$folderName}\n"
                                . "⚙️ *Type:* {$type}\n"
                                . "🔗 [View Firmware]({$viewUrl})"
                            );

                            Notification::make()
                                ->success()
                                ->title('File created successfully')
                                ->body("Added: {$firmware->name}")
                                ->send();

                        } catch (\Exception $e) {
                            Notification::make()
                                ->danger()
                                ->title('Error creating file')
                                ->body($e->getMessage())
                                ->send();
                        }
                    })
                    ->modalSubmitActionLabel('Insert File')
                    ->modalCancelActionLabel('Cancel'),
            ])
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