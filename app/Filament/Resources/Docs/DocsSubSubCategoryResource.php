<?php

namespace App\Filament\Resources\Docs;

use App\Filament\Resources\Docs\DocsSubSubCategoryResource\Pages;
use App\Filament\Resources\Docs\DocsSubSubCategoryResource\RelationManagers;
use App\Models\Docs\DocsSubSubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Docs\DocsCategory;
use App\Models\Docs\DocsSubCategory;
use Filament\Forms\Components\Select;

class DocsSubSubCategoryResource extends Resource
{
    protected static ?string $model = DocsSubSubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';
    protected static ?string $navigationGroup = 'Docs Management';
    protected static ?string $navigationLabel = 'Sub Sub-Category';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('Category')
                    ->options(DocsCategory::pluck('name', 'id'))
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->afterStateUpdated(fn(callable $set) => $set('sub_category_id', null)),

                Select::make('sub_category_id')
                    ->label('Sub Category')
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->options(function (callable $get) {
                        $categoryId = $get('category_id');

                        if (!$categoryId) {
                            return [];
                        }

                        return DocsSubCategory::where('category_id', $categoryId)->pluck('name', 'id');
                    }),

                TextInput::make('name')
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
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sub_category_id')
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
            'index' => Pages\ListDocsSubSubCategories::route('/'),
            'create' => Pages\CreateDocsSubSubCategory::route('/create'),
            'view' => Pages\ViewDocsSubSubCategory::route('/{record}'),
            'edit' => Pages\EditDocsSubSubCategory::route('/{record}/edit'),
        ];
    }
}
