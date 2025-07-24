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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Clusters\Announcements;
use Illuminate\Support\Str;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $cluster = Announcements::class;
    protected static ?string $navigationLabel = 'Announcements';
    protected static ?string $slug = "announcements";

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id(); // Pastikan user login
        return $data;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('announcement_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                RichEditor::make('content')
                    ->label('Content')
                    ->required(),

                FileUpload::make('attachment_path')
                    ->label('Attachment')
                    ->downloadable()
                    ->openable()
                    ->preserveFilenames()
                    ->directory(function () {
                        // Folder dinamis: berdasarkan tanggal + random string
                        $timestamp = now()->format('Ymd_His');
                        return "attachments/announcement/{$timestamp}_" . Str::random(6);
                    })
                    ->visibility('public'),

                Toggle::make('is_pinned')
                    ->label('Pin this announcement?')
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Category'),
                TextColumn::make('user.name')->label('Posted By'),
                TextColumn::make('created_at')->dateTime('d M Y'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->filters([
                //
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
