<?php

namespace App\Filament\Resources\Announcement;

use App\Filament\Resources\Announcement\AnnouncementResource\Pages;
use App\Filament\Resources\Announcement\AnnouncementResource\RelationManagers;
use App\Models\Announcement\Announcement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Grid;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationGroup = 'Manajemen Pengumuman';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        // === Kolom Kiri ===
                        Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')->required(),

                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name')
                                    ->required(),

                                Forms\Components\Select::make('type')
                                    ->options([
                                        'info' => 'Info',
                                        'success' => 'Success',
                                        'warning' => 'Warning',
                                        'danger' => 'Danger',
                                    ])
                                    ->default('info'),


                                Forms\Components\FileUpload::make('attachment_path')
                                    ->disk('public')
                                    ->label('Lampiran')
                                    ->directory('announcements/attachments')
                                    ->acceptedFileTypes([
                                        'application/pdf',
                                        'application/vnd.ms-excel',
                                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                        'image/*',
                                    ]),
                            ]),

                        // === Kolom Kanan ===
                        Grid::make()
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif ?')
                                    ->default(true),

                                Forms\Components\Toggle::make('is_pinned')
                                    ->label('Pin to Top'),
                                Forms\Components\DateTimePicker::make('starts_at')
                                    ->label('Mulai Tayang'),

                                Forms\Components\DateTimePicker::make('ends_at')
                                    ->label('Berakhir Tayang'),

                                Forms\Components\Hidden::make('user_id')
                                    ->default(auth()->id()),

                                RichEditor::make('content')
                                    ->label('Isi Pengumuman')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('type')->colors([
                    'info' => 'info',
                    'success' => 'success',
                    'warning' => 'warning',
                    'danger' => 'danger',
                ]),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori'),
                Tables\Columns\TextColumn::make('author.name')->label('Author'),
                Tables\Columns\ToggleColumn::make('is_active'),
                Tables\Columns\ToggleColumn::make('is_pinned'),
                Tables\Columns\TextColumn::make('starts_at')->dateTime(),
                Tables\Columns\TextColumn::make('ends_at')->dateTime(),
            ])->defaultSort('starts_at', 'desc')
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
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
