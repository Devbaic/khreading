<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategorieResource\Pages;
use App\Filament\Resources\CategorieResource\RelationManagers;
use App\Models\Categorie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ActionGroup;
class CategorieResource extends Resource
{
    protected static ?string $model = Categorie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            Forms\Components\Section::make('Basic Information')
                ->description('Enter the key details below.')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Name')
                        ->placeholder('Enter full name...')
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-user') // 👤 User icon
                        ->helperText('This will appear publicly.'),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->placeholder('e.g. john-doe')
                        ->required()
                        ->maxLength(255)
                        ->prefixIcon('heroicon-o-link') // 🔗 Link icon
                        ->reactive()
                        ->helperText('Auto-generated from the name if left empty.'),

                   Forms\Components\TextInput::make('status')
                        ->label('Status')
                        ->default(1)
                        ->required()
                        ->prefixIcon('heroicon-o-check-circle') // prefix icon
                        ->suffixAction(
                            Forms\Components\Actions\Action::make('toggleStatus')
                                ->icon(fn ($state) => $state == 1 ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle') // valid icons
                                ->tooltip('Toggle status')
                                ->action(fn (Forms\Set $set, $state) => $set('status', $state == 1 ? 0 : 1))
                        )

                ])
                ->columns(2)
                ->icon('heroicon-o-information-circle') // Section icon
                ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-newspaper') // 👤 prefix icon
                    ->color('primary')
                    ->tooltip('Click to view details')
                    ->formatStateUsing(fn ($state) => ucwords($state))
                    ->copyable()
                    ->copyMessage('Name copied!')
                    ->copyMessageDuration(1500),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-link') // 🔗 link icon
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('Slug copied!')
                    ->tooltip('URL identifier'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->numeric()
                    ->sortable()
                    ->badge() // 👌 makes it a colored badge
                    ->color(fn ($state): string => match ($state) {
                        1 => 'success',   // green for active
                        0 => 'danger',    // red for inactive
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => $state == 1 ? 'Active' : 'Inactive')
                    ->icon(fn ($state) => $state == 1 ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y h:i A') // 📅 clean readable format
                    ->sortable()
                    ->icon('heroicon-o-calendar-days')
                    ->color('gray')
                    ->tooltip(fn ($state) => $state?->diffForHumans())
                    ->toggleable(isToggledHiddenByDefault: true),
                            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->color('primary')
                    ->icon('heroicon-o-pencil'),
                Tables\Actions\DeleteAction::make()
                    ->label('Delete')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->icon('heroicon-o-trash'),
            ])
            ->size(ActionSize::Small)
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
            'index' => Pages\ListCategories::route('/'),
            // 'create' => Pages\CreateCategorie::route('/create'),
            // 'view' => Pages\ViewCategorie::route('/{record}'),
            // 'edit' => Pages\EditCategorie::route('/{record}/edit'),
        ];
    }
}
