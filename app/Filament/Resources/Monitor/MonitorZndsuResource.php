<?php

namespace App\Filament\Resources\Monitor;

use App\Filament\Resources\Monitor\MonitorZndsuResource\Pages;
use App\Filament\Resources\Monitor\MonitorZndsuResource\RelationManagers;
use App\Models\Monitor\MonitorZndsu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonitorZndsuResource extends Resource
{
    protected static ?string $model = MonitorZndsu::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static ?string $navigationGroup = 'Data Monitoring';
    protected static ?string $navigationLabel = 'Upload Data Zndsu';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('plant')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_dist')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rom_id')
                    ->numeric(),
                Forms\Components\TextInput::make('nom_id')
                    ->numeric(),
                Forms\Components\TextInput::make('it_id')
                    ->numeric(),
                Forms\Components\DatePicker::make('uploaded_at')
                    ->required(),
                Forms\Components\Toggle::make('has_error')
                    ->required(),
                Forms\Components\TextInput::make('day_01')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_02')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_03')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_04')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_05')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_06')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_07')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_08')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_09')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_10')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_11')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_12')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_13')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_14')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_15')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_16')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_17')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_18')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_19')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_20')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_21')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_22')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_23')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_24')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_25')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_26')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_27')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_28')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_29')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_30')
                    ->maxLength(255),
                Forms\Components\TextInput::make('day_31')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_dist')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rom_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nom_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('it_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('uploaded_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('has_error')
                    ->boolean(),
                Tables\Columns\TextColumn::make('day_01')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_02')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_03')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_04')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_05')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_06')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_07')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_08')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_09')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_10')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_11')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_12')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_13')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_14')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_15')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_16')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_17')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_18')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_19')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_20')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_21')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_22')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_23')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_24')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_25')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_26')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_27')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_28')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_29')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_30')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_31')
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
            'index' => Pages\ListMonitorZndsus::route('/'),
            'create' => Pages\CreateMonitorZndsu::route('/create'),
            'view' => Pages\ViewMonitorZndsu::route('/{record}'),
            'edit' => Pages\EditMonitorZndsu::route('/{record}/edit'),
        ];
    }
}
