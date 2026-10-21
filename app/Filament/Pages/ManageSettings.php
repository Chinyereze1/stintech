<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?int $navigationSort = 0;

    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        // Guarantees a settings row always exists — you're never staring at
        // an empty "create new" form, just your actual current settings.
        $setting = Setting::firstOrCreate([]);

        $data = $setting->toArray();
        $data['visibility'] = array_merge(Setting::defaultVisibility(), $data['visibility'] ?? []);

        $this->form->fill($data);
    }

    public function form(Form $form): Form
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
                                    ->default('#3b82f6'),
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

                        Tabs\Tab::make('Legal')
                            ->icon('heroicon-o-scale')
                            ->schema([
                                RichEditor::make('privacy_policy')
                                    ->label('Privacy Policy')
                                    ->columnSpanFull(),
                                RichEditor::make('terms_of_service')
                                    ->label('Terms of Service')
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Visibility')
                            ->icon('heroicon-o-eye')
                            ->schema([
                                \Filament\Forms\Components\Section::make('Homepage Sections')
                                    ->schema([
                                        Toggle::make('visibility.home_quick_stats')->label('Quick Stats band')->default(true),
                                        Toggle::make('visibility.home_services')->label('Services section')->default(true),
                                        Toggle::make('visibility.home_featured_projects')->label('Featured Projects section')->default(true),
                                        Toggle::make('visibility.home_who_we_are')->label('Who We Are / Why Choose Us')->default(true),
                                        Toggle::make('visibility.home_tech_stack')->label('Tech Stack section')->default(true),
                                        Toggle::make('visibility.home_cta')->label('CTA band (before footer)')->default(true),
                                    ])
                                    ->columns(2),

                                \Filament\Forms\Components\Section::make('Pages')
                                    ->description('Turning a page off removes it from the nav and makes it unreachable.')
                                    ->schema([
                                        Toggle::make('visibility.page_service')->label('Service page')->default(true),
                                        Toggle::make('visibility.page_project')->label('Project page')->default(true),
                                        Toggle::make('visibility.page_about')->label('About page')->default(true),
                                        Toggle::make('visibility.page_contact')->label('Contact page')->default(true),
                                    ])
                                    ->columns(2),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $setting = Setting::firstOrCreate([]);
        $setting->update($this->form->getState());

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}