<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faqs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ActionGroup;
class FaqResource extends Resource
{
    protected static ?string $model = Faqs::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

    Forms\Components\TextInput::make('question')
        ->label('Question')
        ->placeholder('Enter the question here...')
        ->required()
        ->columnSpan(2)
        ->prefixIcon('heroicon-o-question-mark-circle'),



        Forms\Components\RichEditor::make('answer')
            ->label('Answer')
            ->placeholder('Type the detailed answer here...')
            ->toolbarButtons([
                'bold',
                'italic',
                'strike',
                'bulletList',
                'orderedList',
                'blockquote',
                'link',
                'undo',
                'redo',
            ])
            ->fileAttachmentsDisk('public') // optional: allow image uploads
            ->fileAttachmentsDirectory('uploads/answers')
            ->fileAttachmentsVisibility('public')
            ->required()
            ->columnSpanFull() // makes it take full width across all columns
            ->extraAttributes(['style' => 'min-height: 250px;']),

    Forms\Components\TextInput::make('status')
        ->label('Status')
        ->default(1)
        ->required()
        ->prefixIcon('heroicon-o-check-circle')
        ->disabled() // prevent direct typing
        ->suffixAction(
            Forms\Components\Actions\Action::make('toggleStatus')
                ->icon(fn ($state) => $state == 1
                    ? 'heroicon-o-check-circle'
                    : 'heroicon-o-x-circle')
                ->color(fn ($state) => $state == 1 ? 'success' : 'danger')
                ->tooltip(fn ($state) => $state == 1
                    ? 'Currently Active — Click to Deactivate'
                    : 'Currently Inactive — Click to Activate')
                ->action(fn (Set $set, $state) => $set('status', $state == 1 ? 0 : 1))
        )
->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('question')
                ->label('Question')
                ->limit(60)
                ->tooltip(fn ($record) => $record->question)
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('answer')
                ->label('Answer')
                ->formatStateUsing(fn ($state) => strip_tags($state)) // remove <p>, <br>, etc.
                ->limit(60) // show first 60 characters
                ->tooltip(fn ($record) => strip_tags($record->answer)) // full text on hover
                ->searchable()
                ->sortable()
                ->wrap(),
            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn ($state) => $state == 1 ? 'success' : 'danger')
                ->formatStateUsing(fn ($state) => $state == 1 ? 'Active' : 'Inactive'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Created')
                ->dateTime('M d, Y')
                ->sortable(),
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
            'index' => Pages\ListFaqs::route('/'),
            // 'create' => Pages\CreateFaq::route('/create'),
            // 'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
