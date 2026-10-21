<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Toggle;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Messages';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $count = ContactMessage::where('is_read', false)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('name')
                    ->content(fn (ContactMessage $record) => $record->name),
                Placeholder::make('email')
                    ->content(fn (ContactMessage $record) => $record->email),
                Placeholder::make('subject')
                    ->content(fn (ContactMessage $record) => $record->subject ?: '—'),
                Placeholder::make('message')
                    ->content(fn (ContactMessage $record) => $record->message)
                    ->columnSpanFull(),
                Toggle::make('is_read')
                    ->label('Read'),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->label('')
                    ->icon(fn (bool $state) => $state ? 'heroicon-o-envelope-open' : 'heroicon-o-envelope')
                    ->color(fn (bool $state) => $state ? 'gray' : 'primary'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('subject')
                    ->limit(40)
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('M j, Y g:ia')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('View'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }
}
