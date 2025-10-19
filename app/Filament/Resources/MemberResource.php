<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Section::make('👥 Team Members')
                ->description('Add and manage team members details.')
                ->icon('heroicon-o-user') // ✅ Section icon
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('👤 Name')
                                ->placeholder('Enter full name...')
                                ->required()
                                ->maxLength(255)
                                ->prefixIcon('heroicon-o-user'),

                            Forms\Components\TextInput::make('designation')
                                ->label('💼 Designation')
                                ->placeholder('Enter designation...')
                                ->required()
                                ->maxLength(255)
                                ->prefixIcon('heroicon-o-briefcase'),
                        ]),

                    Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\TextInput::make('fb_url')
                                ->label('🔗 Facebook URL')
                                ->placeholder('Enter Facebook profile URL...')
                                ->maxLength(255)
                                ->prefixIcon('heroicon-o-link'),

                            Forms\Components\TextInput::make('tk_url')
                                ->label('🔗 TikTok URL')
                                ->placeholder('Enter TikTok profile URL...')
                                ->maxLength(255)
                                ->prefixIcon('heroicon-o-link'),

                            Forms\Components\TextInput::make('in_url')
                                ->label('🔗 LinkedIn URL')
                                ->placeholder('Enter LinkedIn profile URL...')
                                ->maxLength(255)
                                ->prefixIcon('heroicon-o-link'),
                        ]),

                    Forms\Components\FileUpload::make('image')
                        ->label('🖼️ Profile Image')
                        ->image()
                        ->directory('members')
                        ->maxSize(2048)
                        ->placeholder('Upload profile image...')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\Select::make('status')
                        ->label('📊 Status')
                        ->options([
                            1 => 'Active',
                            0 => 'Inactive',
                        ])
                        ->required()
                        ->default(1)
                        ->prefixIcon('heroicon-o-rectangle-stack'), // ✅ Updated icon name
                ])
                ->columns(1)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('🖼️ Image')
                    ->rounded()
                    ->height(50)
                    ->width(50),
                Tables\Columns\TextColumn::make('name')
                    ->label('👤 Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('designation')
                    ->label('💼 Designation')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('📊 Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('🗓️ Created At')
                    ->dateTime('M d, Y H:i')
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
            'index' => Pages\ListMembers::route('/'),
            // 'create' => Pages\CreateMember::route('/create'),
            // 'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
