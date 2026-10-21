<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
        Tabs::make('Website Settings')
            ->tabs([
                Tabs\Tab::make('Identity')
                    ->icon('heroicon-o-finger-print')
                    ->schema([
                        TextInput::make('site_name')->label('Brand Name (e.g., Stintech)'),
                        FileUpload::make('logo_light')
                            ->image()
                            ->disk('uploads')
                            ->directory('settings')
                            ->label('Logo for Light Mode'),
                        FileUpload::make('logo_dark')
                            ->image()
                            ->disk('uploads')
                            ->directory('settings')
                            ->label('Logo for Dark Mode'),
                        FileUpload::make('favicon')
                            ->image()
                            ->disk('uploads')
                            ->directory('settings'),
                    ]),

                Tabs\Tab::make('Design & Colors')
                    ->icon('heroicon-o-paint-brush')
                    ->schema([
                        ColorPicker::make('accent_color')
                            ->label('Primary Accent Color')
                            ->default('#3b82f6'), // Default blue
                        Select::make('template_style')
                            ->options([
                                'modern' => 'Modern Sleek',
                                'minimal' => 'Minimalist',
                                'bold' => 'Tech Bold',
                            ])->default('modern'),
                    ]),

                Tabs\Tab::make('Resume / CV')
                    ->icon('heroicon-o-document-arrow-down')
                    ->schema([
                        FileUpload::make('cv_file')
                            ->label('CV / Resume (PDF)')
                            ->disk('uploads')
                            ->directory('cv')
                            ->acceptedFileTypes(['application/pdf'])
                            ->helperText('Uploading a new file here updates the "Download CV" button on your About page.'),
                    ]),

                Tabs\Tab::make('Social & Contact')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([
                        TextInput::make('whatsapp_number')->tel(),
                        TextInput::make('contact_email')->email(),
                        TextInput::make('linkedin_url')->url(),
                        TextInput::make('github_url')->url(),
                    ]),

                Tabs\Tab::make('Feature Toggles')
                    ->icon('heroicon-o-cpu-chip')
                    ->schema([
                        Toggle::make('enable_blog')->label('Activate Blog Section'),
                        Toggle::make('enable_quote')->label('Activate Quick Quote System'),
                    ]),
            ])->columnSpanFull()
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}
