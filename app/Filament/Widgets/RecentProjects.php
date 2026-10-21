<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentProjects extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Recently Updated Projects';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()->latest('updated_at')->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('')
                    ->disk('uploads')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('category.name')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => $state === 'published' ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->url(fn (Project $record) => ProjectResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
