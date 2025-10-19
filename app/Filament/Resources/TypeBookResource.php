<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeBookResource\Pages;
use App\Filament\Resources\TypeBookResource\RelationManagers;
use App\Models\Kind;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
class TypeBookResource extends Resource
{
    protected static ?string $model = Kind::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Name')
                ->placeholder('Enter name...')
                ->required()
                ->maxLength(255)
                ->prefixIcon('heroicon-o-user') // 👤 Name icon
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('image')
                ->label('Featured Image')
                ->image()
                ->directory('uploads/images')
                ->visibility('public')
                ->imageEditor()
                ->imagePreviewHeight('200')
                ->loadingIndicatorPosition('left')
                ->panelAspectRatio('2:1')
                ->hintIcon('heroicon-o-photo') // 🖼️ Image icon
                ->hint('Upload a clear and professional image.')
                ->columnSpan(2),

            Forms\Components\MarkdownEditor::make('description')
                ->label('Description')
                ->placeholder('Write a detailed description...')
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'heading',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'table',
                    'undo',
                ])
                ->minHeight('300px')
                ->columnSpanFull()
                ->hintIcon('heroicon-o-information-circle') // ℹ️ Info icon next to hint
                ->hint('You can use Markdown formatting for rich text content.'),
        ])
        ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Image')
                ->circular() // makes it round and clean
                ->size(50)   // uniform thumbnail size
                ->extraImgAttributes(['loading' => 'lazy'])
                ->tooltip(fn ($record) => $record->name), // hover shows name

            Tables\Columns\TextColumn::make('name')
                ->label('Name')
                ->searchable()
                ->sortable()
                ->icon('heroicon-o-book-open') // 📖 Book icon
                ->description(fn ($record) => $record->slug ?? null, position: 'below') // optional subtext
                ->weight('bold')
                ->color('primary')
                ->toggleable(true),

            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->limit(60)
                ->wrap()
                ->sortable()
                ->toggleable(true)
                ->tooltip(fn ($record) => strip_tags($record->description)), // show full text on hover

            Tables\Columns\TextColumn::make('created_at')
                ->label('Created')
                ->dateTime('d M Y, H:i')
                ->sortable()
                ->sortable()
                ->color('gray')
                ->icon('heroicon-o-calendar')
                ->toggleable(true),
        ])
        ->defaultSort('created_at', 'desc')
        ->striped() // zebra row style for readability
        ->paginated([10, 25, 50])
        ->filters([
            // Example: Add your custom filters here
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
            'index' => Pages\ListTypeBooks::route('/'),
            // 'create' => Pages\CreateTypeBook::route('/create'),
            // 'edit' => Pages\EditTypeBook::route('/{record}/edit'),
        ];
    }
}
