<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationGroup = 'Dynamic Pages';
    protected static ?int $navigationSort = 1;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                ->label('Tiêu Đề')
                ->required(),
                SpatieMediaLibraryFileUpload::make('Hình Ảnh')
                ->image()
                ->imageEditor()
                ->responsiveImages(),
                TextInput::make('short_description')
                ->label('Mô tả ngắn')
                ->required(),
                Select::make('status')->label('Trạng Thái')
                ->options([
                    1=> 'Active',
                    0=>'Block'
                ])->required(),
                TiptapEditor::make('description')->label('Nội Dung')
                ->columnSpan(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('title'),
            TextColumn::make('short_description')->formatStateUsing(function($state){
                return \Str::limit($state,20);
            }),
            TextColumn::make('status')
                ->formatStateUsing(function ($state) {
                    return $state ? 'Active' : 'Block';
                })
                ->label('Status')
                ->color(fn ($state) => $state ? 'success' : 'danger'),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
