<?php

namespace App\Filament\Resources\Master;

use App\Filament\Resources\Master\DataDistResource\Pages;
use App\Filament\Resources\Master\DataDistResource\RelationManagers;
use App\Models\Master\DataDist;
use App\Models\Master\DataROM;
use App\Models\Master\DataNOM;
use App\Models\Master\DataIT;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataDistResource extends Resource
{
    protected static ?string $model = DataDist::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Data Distribution';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('branch')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('plant')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code_dist')
                    ->numeric(),
                Forms\Components\TextInput::make('name_dist')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status_dist')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('channel')
                    ->maxLength(255),
                Forms\Components\Select::make('rom_id')
                    ->label('ROM')
                    ->options(DataROM::pluck('name', 'id'))
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('nom_id')
                    ->label('NOM')
                    ->options(DataNOM::pluck('name', 'id'))
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('it_id')
                    ->label('IT')
                    ->options(DataIT::pluck('name', 'id'))
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('region')
                    ->maxLength(255),
                Forms\Components\Toggle::make('status_plant')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branch')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code_dist')
                    ->label('Kode Dist')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name_dist')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_dist')
                    ->searchable(),
                Tables\Columns\TextColumn::make('channel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rom.name')
                    ->label('ROM')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nom.name')
                    ->label('NOM')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('it.name')
                    ->label('IT')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status_plant')
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
            'index' => Pages\ListDataDists::route('/'),
            'create' => Pages\CreateDataDist::route('/create'),
            'view' => Pages\ViewDataDist::route('/{record}'),
            'edit' => Pages\EditDataDist::route('/{record}/edit'),
        ];
    }
}
