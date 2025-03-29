<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\Auth;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-minus';
    protected static ?string $navigationLabel = 'Post';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int $navigationSort = 3;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                Select::make('category_id')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->label('Category')
                    ->required(),
                Select::make('tags')
                    ->preload()
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->label('Tags'),
                Select::make('user_id')
                    ->options(User::all()->pluck('name', 'id'))
                    ->label('Author')
                    ->required()
                    ->default(Auth::id()),
                FileUpload::make('image')->required()->label('Image feature'),
                Select::make('status')->options([1 => 'Active', 0 => 'Block'])->required(),
                TiptapEditor::make('content')->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('status')
                    ->formatStateUsing(fn($state) => $state ? 'Active' : 'Block')
                    ->label('Status')
                    ->color(fn($state) => $state ? 'success' : 'danger'),
                TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                    TextColumn::make('tags')
                    ->label('Tags')
                    ->formatStateUsing(fn ($record) => $record->tags->pluck('name')->join(', '))
                    ->searchable(),

            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->preload()
                    ->label('Filter by Author'),
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->preload()
                    ->label('Filter by Category'),
                SelectFilter::make('tags')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->label('Filter by Tags'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function saved($record, $formData)
    {
        // Đồng bộ các tag vào bảng pivot tag_article
        $record->tags()->sync($formData['tags'] ?? []);
    }
}
