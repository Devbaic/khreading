<?php

namespace App\Filament\Resources;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ActionGroup;
use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('📚 Name')
                    ->placeholder('Enter name...')
                    ->prefixIcon('heroicon-o-book-open')
                    ->required(),

                Forms\Components\Select::make('typebook_id')
                    ->label('🏷️ Type Book')
                    ->placeholder('Select Type Book...')
                    ->prefixIcon('heroicon-o-tag')
                    ->relationship('typebook', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('author')
                    ->label('✍️ Author')
                    ->placeholder('Enter author...')
                    ->prefixIcon('heroicon-o-user')
                    ->required()
                    ->columnSpan(2),

                Forms\Components\FileUpload::make('image')
                    ->label('🖼️ Featured Image')
                    ->image()
                    ->visibility('public')
                    ->hint('Upload a cover or preview image.')
                    ->hintIcon('heroicon-o-photo')
                    ->columnSpan(2),

                Forms\Components\FileUpload::make('filebook')
                    ->label('📘 File Book')
                    ->placeholder('Upload book file...')
                    ->visibility('public')
                    ->required()
                    ->hint('Supported formats: PDF, ePub, etc.')
                    ->hintIcon('heroicon-o-document-arrow-up')
                    ->columnSpan(2),
                    Forms\Components\TextInput::make('flip_url')
                        ->label('Flipbook URL')            // Friendly label
                        ->placeholder('https://online.anyflip.com/xxxx/') // Hint for admin
                        ->url()                             // Validates that it’s a URL
                        ->maxLength(255)                    // Database-friendly length
                        ->helperText('Optional: Add flipbook URL if available')
                        ->columnSpan('full'),
                Forms\Components\MarkdownEditor::make('description')
                    ->label('📝 Description')
                    ->placeholder('Write a detailed description...')
                    ->toolbarButtons([
                        'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock', 'heading',
                        'italic', 'link', 'orderedList', 'redo', 'strike', 'table', 'undo',
                    ])
                    ->minHeight('300px')
                    ->columnSpanFull()
                    ->hintIcon('heroicon-o-information-circle')
                    ->hint('You can use Markdown formatting for rich text content.'),

                Forms\Components\Select::make('status')
                    ->label('💎 Status')
                    ->options([
                        'free' => 'Free',
                        'premium' => 'Premium',
                    ])
                    ->required()
                    ->placeholder('Select status...')
                    ->prefixIcon('heroicon-o-currency-dollar')
                    ->columnSpan(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('📘 Image')
                    ->rounded()
                    ->size(50)
                    ->circular()
                    ->tooltip('Featured image'),

                Tables\Columns\TextColumn::make('name')
                    ->label('📖 Name')
                    ->icon('heroicon-o-book-open')
                    ->limit(40)
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->tooltip(fn ($record) => $record->name),

                Tables\Columns\TextColumn::make('typebook.name')
                    ->label('🏷️ Type')
                    ->icon('heroicon-o-tag')
                    ->sortable()
                    ->searchable()
                    ->color('info')
                    ->badge()
                    ->tooltip(fn ($record) => $record->typebook?->name),

                Tables\Columns\TextColumn::make('author')
                    ->label('✍️ Author')
                    ->icon('heroicon-o-user')
                    ->limit(40)
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('flip_url')
                    ->label('Flipbook URL')
                    ->icon('heroicon-o-link')
                    ->limit(50)
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->url(fn ($record) => $record->flip_url)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('description')
                    ->label('📝 Description')
                    ->icon('heroicon-o-document-text')
                    ->limit(60)
                    ->wrap()
                    ->toggleable(true)
                    ->tooltip(fn ($record) => strip_tags($record->description)),
                Tables\Columns\TextColumn::make('status')
                    ->label('💎 Status')
                    ->icon('heroicon-o-currency-dollar')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->colors([
                        'success' => 'free',
                        'warning' => 'premium',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('📅 Created')
                    ->icon('heroicon-o-calendar')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->color('gray')
                    ->toggleable(true)
                    ->tooltip(fn ($record) => $record->created_at->diffForHumans()),
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
            'index' => Pages\ListBooks::route('/'),
            // 'create' => Pages\CreateBook::route('/create'),
            // 'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
