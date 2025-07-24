<?php

namespace App\Filament\Resources\Docs;

use App\Filament\Resources\Docs\DocsTopicResource\Pages;
use App\Filament\Resources\Docs\DocsTopicResource\RelationManagers;
use App\Models\Docs\DocsCategory;
use App\Models\Docs\DocsSubCategory;
use App\Models\Docs\DocsTopic;
use Filament\Forms\Components\TextInput;
use App\Models\Docs\DocsSubSubCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Comment\Doc;
use App\Filament\Clusters\DocsSettings;

class DocsTopicResource extends Resource
{
    protected static ?string $model = DocsTopic::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Docs Management';
    protected static ?string $navigationLabel = 'Topics';
    protected static ?string $cluster = DocsSettings::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('category_id')
                    ->label('Kategori')
                    ->options(DocsCategory::pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('sub_category_id', null)),

                Select::make('sub_category_id')
                    ->label('Sub Kategori')
                    ->options(function (callable $get) {
                        $categoryId = $get('category_id');
                        if (!$categoryId) {
                            return [];
                        }
                        return DocsSubCategory::where('category_id', $categoryId)->pluck('name', 'id');
                    })
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('sub_sub_category_id', null)),

                Select::make('sub_sub_category_id')
                    ->label('Sub Sub Kategori')
                    ->options(function (callable $get) {
                        $subCategoryId = $get('sub_category_id');
                        if (!$subCategoryId) {
                            return [];
                        }
                        return DocsSubSubCategory::where('sub_category_id', $subCategoryId)->pluck('name', 'id');
                    })
                    ->searchable(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('file_path')
                    ->label('File PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240),

                TextInput::make('video_url')
                    ->url()
                    ->maxLength(255)
                    ->label('Video URL'),
                RichEditor::make('content')
                    ->columnSpan(2)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(20) // opsional, untuk ringkas
                    ->searchable(),

                Tables\Columns\TextColumn::make('content')
                    ->limit(15) // opsional, untuk ringkas
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('subCategory.name')
                    ->label('Sub Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('subSubCategory.name')
                    ->label('Sub Sub Category')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListDocsTopics::route('/'),
            'create' => Pages\CreateDocsTopic::route('/create'),
            'view' => Pages\ViewDocsTopic::route('/{record}'),
            'edit' => Pages\EditDocsTopic::route('/{record}/edit'),
        ];
    }
}
