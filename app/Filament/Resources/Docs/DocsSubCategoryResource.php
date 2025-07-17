<?php

namespace App\Filament\Resources\Docs;

use App\Filament\Resources\Docs\DocsSubCategoryResource\Pages;
use App\Filament\Resources\Docs\DocsSubCategoryResource\RelationManagers;
use App\Models\Docs\DocsSubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Docs\DocsCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Comment\Doc;

class DocsSubCategoryResource extends Resource
{
    protected static ?string $model = DocsSubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationGroup = 'Docs Management';
    protected static ?string $navigationLabel = 'Sub Category';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('category_id')->label('Category')->options(DocsCategory::all()->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListDocsSubCategories::route('/'),
            'create' => Pages\CreateDocsSubCategory::route('/create'),
            'view' => Pages\ViewDocsSubCategory::route('/{record}'),
            'edit' => Pages\EditDocsSubCategory::route('/{record}/edit'),
        ];
    }
}
