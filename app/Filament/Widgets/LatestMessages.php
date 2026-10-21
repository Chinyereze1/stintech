<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMessages extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Latest Messages';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactMessage::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('')
                    ->icon(fn (bool $state) => $state ? 'heroicon-o-envelope-open' : 'heroicon-o-envelope')
                    ->color(fn (bool $state) => $state ? 'gray' : 'primary'),
                Tables\Columns\TextColumn::make('name')
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('email')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('subject')
                    ->limit(30)
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->url(fn (ContactMessage $record) => ContactMessageResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
