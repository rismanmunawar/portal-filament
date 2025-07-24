<?php

namespace App\Filament\Resources\Announcement;

use App\Filament\Resources\Announcement\AnnouncementCategoryResource\Pages;
use App\Filament\Resources\Announcement\AnnouncementCategoryResource\RelationManagers;
use App\Models\Announcement\AnnouncementCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Clusters\Announcements;

class AnnouncementCategoryResource extends Resource
{
    protected static ?string $model = AnnouncementCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Category';
    protected static ?string $cluster = Announcements::class;
    protected static ?string $slug = "categories";

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Category Name')
                ->required()
                ->maxLength(255),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime('d M Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAnnouncementCategories::route('/'),
            'create' => Pages\CreateAnnouncementCategory::route('/create'),
            'edit' => Pages\EditAnnouncementCategory::route('/{record}/edit'),
        ];
    }
}
