<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShareResource\Pages;
use App\Filament\Resources\ShareResource\RelationManagers;
use App\Models\Share;
use Filament\Forms;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShareResource extends Resource
{
    protected static ?string $model = Share::class;

    protected static ?string $navigationIcon = 'heroicon-o-share';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('📚 Book Sharing ')
                    ->description('Provide details about the book you are sharing.')
                    ->icon('heroicon-o-book-open')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name_share')
                                    ->label('👤 Shared By')
                                    ->placeholder('Enter your name...')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-user'),

                                Forms\Components\TextInput::make('name_book')
                                    ->label('📖 Book Name')
                                    ->placeholder('Enter the book name...')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-document-text'),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('typebook_id')
                                    ->label('🏷️ Type Book')
                                    ->placeholder('Select book type...')
                                    ->prefixIcon('heroicon-o-tag')
                                    ->relationship('typebook', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required(),

                                Forms\Components\Select::make('status')
                                    ->label('💎 Status')
                                    ->options([
                                        'free' => 'Free',
                                        'premium' => 'Premium',
                                    ])
                                    ->required()
                                    ->placeholder('Select status...')
                                    ->prefixIcon('heroicon-o-currency-dollar'),
                            ]),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(false),
                    Forms\Components\FileUpload::make('image')
                                        ->label('🖼️ Featured Image')
                                        ->image()
                                        ->visibility('public')
                                        ->hint('Upload a cover or preview image.')
                                        ->hintIcon('heroicon-o-photo')
                                        ->columnSpan(2),
                    Forms\Components\Section::make('📝 Content & Uploads')
                        ->description('Upload the file and provide a detailed description.')
                        ->icon('heroicon-o-paper-clip')
                        ->schema([
                            Forms\Components\MarkdownEditor::make('description')
                                ->label('📝 Description')
                                ->placeholder('Write a detailed description...')
                                ->toolbarButtons([
                                    'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock', 'heading',
                                    'italic', 'link', 'orderedList', 'redo', 'strike', 'table', 'undo',
                                ])
                                ->minHeight('300px')
                                ->hintIcon('heroicon-o-information-circle')
                                ->hint('You can use Markdown formatting for rich text content.')
                                ->columnSpanFull(),

                            Forms\Components\FileUpload::make('filebook')
                                ->label('📘 File Book')
                                ->placeholder('Upload your book file...')
                                ->visibility('public')
                                ->required()
                                ->hint('Supported formats: PDF, ePub, DOCX, etc.')
                                ->hintIcon('heroicon-o-document-arrow-up')
                                ->columnSpan(2),
                        ])
                        ->columns(2)
                        ->collapsible()
                        ->collapsed(false),

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
                ->tooltip('Featured image of the book'),

            Tables\Columns\TextColumn::make('name_share')
                ->label('👤 Shared By')
                ->icon('heroicon-o-user')
                ->searchable()
                ->sortable()
                ->color('info')
                ->tooltip(fn ($record) => $record->name_share),

            Tables\Columns\TextColumn::make('name_book')
                ->label('📖 Book Name')
                ->icon('heroicon-o-book-open')
                ->limit(40)
                ->wrap()
                ->searchable()
                ->sortable()
                ->tooltip(fn ($record) => $record->name_book),

            Tables\Columns\TextColumn::make('typebook.name')
                ->label('🏷️ Type Book')
                ->icon('heroicon-o-tag')
                ->color('gray')
                ->badge()
                ->searchable()
                ->sortable()
                ->tooltip(fn ($record) => $record->typebook?->name),

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
                ->formatStateUsing(fn (string $state): string => ucfirst($state))
                ->tooltip(fn ($record) => 'Current status: ' . ucfirst($record->status)),

            Tables\Columns\TextColumn::make('created_at')
                ->label('📅 Created At')
                ->icon('heroicon-o-calendar')
                ->dateTime('M d, Y H:i')
                ->sortable()
                ->color('gray')
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
            'index' => Pages\ListShares::route('/'),
            // 'create' => Pages\CreateShare::route('/create'),
            // 'edit' => Pages\EditShare::route('/{record}/edit'),
        ];
    }
}
