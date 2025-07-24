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
use App\Filament\Clusters\AnnouncementSettings;

class AnnouncementCategoryResource extends Resource
{
    protected static ?string $model = AnnouncementCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Manajemen Pengumuman';
    protected static ?string $cluster = AnnouncementSettings::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('slug')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('slug')->searchable(),
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
