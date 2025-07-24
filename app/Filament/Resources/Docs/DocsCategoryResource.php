<?php

namespace App\Filament\Resources\Docs;

use App\Filament\Clusters\DocsSettings;
use App\Filament\Resources\Docs\DocsCategoryResource\Pages;
use App\Filament\Resources\Docs\DocsCategoryResource\RelationManagers;
use App\Models\Docs\DocsCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocsCategoryResource extends Resource
{
    protected static ?string $model = DocsCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Docs Management';
    protected static ?string $navigationLabel = 'Category';
    protected static ?string $cluster = DocsSettings::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDocsCategories::route('/'),
            'create' => Pages\CreateDocsCategory::route('/create'),
            'view' => Pages\ViewDocsCategory::route('/{record}'),
            'edit' => Pages\EditDocsCategory::route('/{record}/edit'),
        ];
    }
}
