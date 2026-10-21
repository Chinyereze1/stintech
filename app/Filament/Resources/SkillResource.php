<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Filament\Resources\SkillResource\RelationManagers;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Profile';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('logo')
                    ->label('Logo/icon')
                    ->image()
                    ->disk('uploads')
                    ->directory('skills')
                    ->imageEditor()
                    ->helperText('A small square logo shown next to this skill (e.g. the Laravel or PHP icon).'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->options([
                        'technical' => 'Technical',
                        'creative' => 'Creative',
                        'soft_skill' => 'Soft skill',
                    ])
                    ->default('technical')
                    ->required(),
                TextInput::make('proficiency')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->default(80),
                Toggle::make('show_on_home')
                    ->label('Show on homepage'),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('')
                    ->disk('uploads')
                    ->square(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('proficiency')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\IconColumn::make('show_on_home')
                    ->label('On homepage')
                    ->boolean(),
            ])
            ->defaultSort('proficiency', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'technical' => 'Technical',
                        'creative' => 'Creative',
                        'soft_skill' => 'Soft skill',
                    ]),
                Tables\Filters\TernaryFilter::make('show_on_home')
                    ->label('On homepage'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
