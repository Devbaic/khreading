<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActicleResource\Pages;
use App\Filament\Resources\ActicleResource\RelationManagers;
use App\Models\Acticle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BadgeColumn;
    use Filament\Forms\Components\RichEditor;
class ActicleResource extends Resource
{
    protected static ?string $model = Acticle::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Article Title')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Enter article title...')
                        ->columnSpan(2),

                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->placeholder('Select a category...'),

                    Forms\Components\TextInput::make('author')
                        ->label('Author Name')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Enter author name...'),

                    Forms\Components\FileUpload::make('image')
                        ->label('Featured Image')
                        ->image()
                        ->imageEditor()
                        ->directory('articles/images')
                        ->visibility('public')
                        ->columnSpan(2)
                        ->helperText('Upload a high-quality featured image (max 2MB).'),

                    Forms\Components\MarkdownEditor::make('content')
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

                    Forms\Components\Toggle::make('status')
                        ->label('Active Status')
                        ->default(true)
                        ->onColor('success')
                        ->offColor('danger')
                        ->onIcon('heroicon-o-check-circle')
                        ->offIcon('heroicon-o-x-circle')
                        ->helperText('Toggle to set the article as active or inactive.'),
                ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->size(50)
                    ->tooltip('Article image'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-document-text')
                    ->iconPosition('before')
                    ->weight('medium')
                    ->color('primary')
                    ->wrap()
                    ->tooltip(fn ($record) => $record->title),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-folder')
                    ->iconPosition('before')
                    ->color('secondary')
                    ->tooltip(fn ($record) => $record->category?->name ?? 'No category'),

                Tables\Columns\TextColumn::make('author')
                    ->label('Author')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user')
                    ->iconPosition('before')
                    ->color('gray')
                    ->tooltip(fn ($record) => $record->author),

                Tables\Columns\TextColumn::make('content')
                    ->label('📝 Content')
                    ->icon('heroicon-o-document-text')
                    ->limit(60)
                    ->wrap()
                    ->toggleable(true)
                    ->tooltip(fn ($record) => strip_tags($record->content)),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state == 1 ? 'Active' : 'Inactive')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->icon(fn ($state) => $state == 1 ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                    ->sortable()
                    ->alignment('center'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y h:i A')
                    ->sortable()
                    ->icon('heroicon-o-calendar-days')
                    ->iconPosition('before')
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
            'index' => Pages\ListActicles::route('/'),
            // 'create' => Pages\CreateActicle::route('/create'),
            // 'edit' => Pages\EditActicle::route('/{record}/edit'),
        ];
    }
}
