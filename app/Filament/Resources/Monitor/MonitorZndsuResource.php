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

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Data Monitoring';
    protected static ?string $navigationLabel = 'Data Monitoring';


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
        // Ambil semua data, bisa dibatasi kalau terlalu besar
        $records = static::getModel()::all();

        // Cek kolom mana yang punya isi
        $dayColumns = [];
        for ($i = 1; $i <= 31; $i++) {
            $dayKey = 'day_' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $label = str_pad($i, 2, '0', STR_PAD_LEFT);

            // Cek apakah ada record yang kolom ini tidak null/kosong
            $hasData = $records->contains(function ($record) use ($dayKey) {
                return !empty($record->{$dayKey});
            });

            if ($hasData) {
                $dayColumns[] = Tables\Columns\IconColumn::make($dayKey)
                    ->label($label)
                    ->icon(fn(?string $state) => match ($state) {
                        'done' => 'heroicon-o-check-circle',
                        'libur' => 'heroicon-o-exclamation-circle',
                        'error' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn(?string $state) => match ($state) {
                        'done' => 'success',
                        'libur' => 'warning',
                        'error' => 'danger',
                        default => 'gray',
                    })
                    ->tooltip(fn(?string $state) => ucfirst($state ?? 'unknown')); // ✅ ini munculkan tooltip
            }
        }

        return $table
            ->columns(array_merge([
                Tables\Columns\TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex()
                    ->alignCenter()
                    ->toggleable(false),

                Tables\Columns\TextColumn::make('plant')
                    ->searchable()
                    ->label('Plant'),

                Tables\Columns\TextColumn::make('name_dist')
                    ->searchable()
                    ->label('Distributor'),

                Tables\Columns\TextColumn::make('rom.name')
                    ->label('ROM')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nom.name')
                    ->label('NOM')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('it.alias')
                    ->label('IT')
                    ->sortable()
                    ->searchable(),

            ], $dayColumns, [
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]))
            ->filters([])
            ->actions([])
            ->bulkActions([])
            ->recordUrl(fn() => null);
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
