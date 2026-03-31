<?php

namespace App\Filament\Resources\Cloud\Packages\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PackagesForm
{
    public static function configure(Schema $form): Schema
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        // Left Section
                        Section::make('Package Configuration')
                            ->schema([
                                // Activate Package
                                Checkbox::make('is_active')
                                    ->label('Activate Package')
                                    ->helperText('Enable or disable this package')
                                    ->default(true),

                                // Price & Period
                                Grid::make()
                                    ->schema([
                                        TextInput::make('price')
                                            ->required()
                                            ->numeric()
                                            ->default(0.00)
                                            ->prefix('$')
                                            ->minValue(0)
                                            ->label('Price'),
                                        
                                        Select::make('period')
                                            ->required()
                                            ->options([
                                                'day' => 'Day',
                                                'week' => 'Week',
                                                'month' => 'Month',
                                                'year' => 'Year',
                                                'one_time' => 'One Time',
                                            ])
                                            ->default('month')
                                            ->label('Period'),
                                    ]),
                                
                                Select::make('currency_id')
                                    ->relationship('currency', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->label('Currency'),

                                // Bandwidth
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('bandwidth')
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->label('Bandwidth'),
                                        
                                        Select::make('bandwidth_unit')
                                            ->options([
                                                'MB' => 'MB',
                                                'GB' => 'GB',
                                                'TB' => 'TB',
                                            ])
                                            ->default('GB')
                                            ->label('Unit'),
                                    ]),
                                
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('total_bandwidth')
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->label('Total Bandwidth'),
                                        
                                        TextInput::make('daily_bandwidth')
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->label('Daily Bandwidth'),
                                    ]),

                                // Usage Files
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('files')
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->label('Files'),
                                        
                                        TextInput::make('files_unit')
                                            ->default('Files')
                                            ->label('Unit'),
                                    ]),

                                // Every
                                TextInput::make('duration_in_months')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->maxValue(60)
                                    ->label('Duration (Months)')
                                    ->helperText('How many months does this package last?'),
                                
                                Select::make('billing_cycle')
                                    ->options([
                                        'monthly' => 'Monthly',
                                        'quarterly' => 'Quarterly',
                                        'semi_annual' => 'Semi-Annual',
                                        'annual' => 'Annual',
                                        'one_time' => 'One Time',
                                    ])
                                    ->default('monthly')
                                    ->label('Billing Cycle'),
                            ]),

                        // Right Section
                        Section::make('Limits & Extras')
                            ->schema([
                                // Usage All Files
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('total_files')
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->label('Total Files Allowed'),
                                        
                                        TextInput::make('daily_files')
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->label('Daily Files Limit'),
                                    ]),

                                // Extra Bandwidth
                                Checkbox::make('allow_extra_bandwidth')
                                    ->label('Allow Extra Bandwidth')
                                    ->default(false)
                                    ->reactive(),
                                
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('extra_bandwidth_price')
                                            ->numeric()
                                            ->default(0)
                                            ->prefix('$')
                                            ->label('Extra Bandwidth Price')
                                            ->visible(fn ($get) => $get('allow_extra_bandwidth')),
                                        
                                        Select::make('extra_bandwidth_unit')
                                            ->options([
                                                'MB' => 'Per MB',
                                                'GB' => 'Per GB',
                                                'TB' => 'Per TB',
                                            ])
                                            ->default('GB')
                                            ->label('Unit')
                                            ->visible(fn ($get) => $get('allow_extra_bandwidth')),
                                    ]),

                                // Extra Files
                                Checkbox::make('allow_extra_files')
                                    ->label('Allow Extra Files')
                                    ->default(false)
                                    ->reactive(),
                                
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('extra_files_price')
                                            ->numeric()
                                            ->default(0)
                                            ->prefix('$')
                                            ->label('Extra Files Price')
                                            ->visible(fn ($get) => $get('allow_extra_files')),
                                        
                                        Select::make('extra_files_unit')
                                            ->options([
                                                'per_file' => 'Per File',
                                                'per_100' => 'Per 100 Files',
                                                'per_1000' => 'Per 1000 Files',
                                            ])
                                            ->default('per_file')
                                            ->label('Unit')
                                            ->visible(fn ($get) => $get('allow_extra_files')),
                                    ]),

                                // Fair Usage
                                Checkbox::make('enable_fair_usage')
                                    ->label('Enable Fair Usage Policy')
                                    ->default(false)
                                    ->reactive(),
                                
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('fair_usage_limit')
                                            ->numeric()
                                            ->default(0)
                                            ->minValue(0)
                                            ->label('Fair Usage Limit')
                                            ->helperText('Limit in percentage or absolute value')
                                            ->visible(fn ($get) => $get('enable_fair_usage')),
                                        
                                        Select::make('fair_usage_type')
                                            ->options([
                                                'percentage' => 'Percentage',
                                                'absolute' => 'Absolute Value',
                                            ])
                                            ->default('percentage')
                                            ->label('Type')
                                            ->visible(fn ($get) => $get('enable_fair_usage')),
                                    ]),
                                
                                TextInput::make('fair_usage_action')
                                    ->default('throttle')
                                    ->label('Action when limit reached')
                                    ->helperText('e.g., throttle, block, notify')
                                    ->visible(fn ($get) => $get('enable_fair_usage')),

                                // Devices
                                TextInput::make('device_limit')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->label('Device Limit')
                                    ->helperText('0 = Unlimited devices'),
                                
                                Checkbox::make('allow_multiple_sessions')
                                    ->label('Allow Multiple Sessions per Device')
                                    ->default(true),

                                // Additional Features
                                Checkbox::make('can_access_password_files')
                                    ->label('Can Access Password Protected Files')
                                    ->default(false)
                                    ->helperText('Allow users to download password-protected files'),
                                
                                Checkbox::make('can_download_original_files')
                                    ->label('Can Download Original Files')
                                    ->default(true),
                                
                                TextInput::make('dhru_fusion_service_id')
                                    ->numeric()
                                    ->nullable()
                                    ->label('Dhru Fusion Service ID')
                                    ->helperText('External service identifier')
                                    ->placeholder('Optional'),
                            ]),
                    ]),

                // Hidden field
                TextInput::make('package_type')
                    ->required()
                    ->default('paid')
                    ->hidden(),
            ]);
    }
}