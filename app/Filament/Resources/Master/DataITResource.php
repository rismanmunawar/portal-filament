<?php

namespace App\Filament\Resources\Master;

use App\Filament\Resources\Master\DataITResource\Pages;
use App\Filament\Resources\Master\DataITResource\RelationManagers;
use App\Models\Master\DataIT;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;


class DataITResource extends Resource
{
    protected static ?string $model = DataIT::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Data IT';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('alias')
                    ->maxLength(255),
                TextInput::make('designation')
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Toggle::make('status')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->minSize(1)
                    // ->maxSize(1024)
                    ->maxSize(5120)
                    ->imageEditor()
                    ->avatar()
                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alias')
                    ->searchable(),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
            'index' => Pages\ListDataITS::route('/'),
            'create' => Pages\CreateDataIT::route('/create'),
            'view' => Pages\ViewDataIT::route('/{record}'),
            'edit' => Pages\EditDataIT::route('/{record}/edit'),
        ];
    }

    public static function getSlug(): string
    {
        return 'md-it'; // custom URL segment
    }
}
