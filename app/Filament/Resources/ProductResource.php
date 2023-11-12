<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                // ->native(false)
                // ->searchable()
                // ->createOptionForm([
                //     Forms\Components\TextInput::make('name')
                //     ->required()
                //     ->maxLength(255),
                //     Forms\Components\Textarea::make('description')
                //     ->required()
                //     ->maxLength(255),
                // ])
                // ->required()
                ,
                Forms\Components\Textarea::make('description')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('$')
                ->maxLength(255),
                // Forms\Components\FileUpload::make('image')
                // ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price')
                ->prefix('$')
                ->sortable(),
                Tables\Columns\TextColumn::make('category.name')->sortable()->searchable(),



            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                ->relationship('category', 'name'),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
