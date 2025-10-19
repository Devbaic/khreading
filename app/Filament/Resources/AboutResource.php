<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\Abouts;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ActionGroup;
class AboutResource extends Resource
{
    protected static ?string $model = Abouts::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('FAQ Details')
                    ->description('Provide the question, detailed answer, and an optional image.')
                    ->icon('heroicon-o-question-mark-circle')
                    ->schema([

                        // Title Field
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->placeholder('Enter title...')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->extraAttributes([
                                'class' => 'text-lg font-semibold',
                                'style' => 'border-radius: 6px; padding: 10px;',
                            ]),

                        // Rich Text Answer Field
                        Forms\Components\RichEditor::make('content')
                            ->label('Content')
                            ->placeholder('Type the detailed content here...')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                                'link',
                                'undo',
                                'redo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('uploads/faqs')
                            ->fileAttachmentsVisibility('public')
                            ->required()
                            ->columnSpanFull(),

                        // Image Upload Field
                        Forms\Components\FileUpload::make('image')
                            ->label('Featured Image')
                            ->image()
                            ->directory('uploads/faqs/images')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->imagePreviewHeight('150')
                            ->imageEditor()
                            ->hint('Optional: Add an image related to the FAQ.')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                ->label('Image')
                ->square()
                ->circular() // or remove for square thumbnails
                ->size(60)
                ->defaultImageUrl(asset('images/placeholder.png'))
                ->toggleable(),

            // Question (Title) Column
            Tables\Columns\TextColumn::make('title')
                ->label('Title')
                ->searchable()
                ->sortable()
                ->limit(60)
                ->tooltip(fn ($record) => $record->title)
                ->description(fn ($record) => Str::limit(strip_tags($record->content), 80))
                ->wrap()
                ->weight('medium')
                ->extraAttributes([
                    'class' => 'text-gray-800 text-base font-semibold',
                ]),

            // Answer Preview (Optional)
            Tables\Columns\TextColumn::make('content')
                ->label('Content')
                ->html()
                ->limit(80)
                ->toggleable(isToggledHiddenByDefault: true)
                ->wrap(),

            // Created At
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created')
                ->date('M d, Y')
                ->sortable()
                ->alignCenter(),

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
            'index' => Pages\ListAbouts::route('/'),
            // 'create' => Pages\CreateAbout::route('/create'),
            // 'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
