<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   public static function form(Form $form): Form
{
    return $form
        ->schema([
            Card::make()
                ->schema([
                    Grid::make(2) // Chia làm 2 cột: name và image
                        ->schema([
                            TextInput::make('name')
                                ->label('Tên danh mục')
                                ->placeholder('Nhập tên danh mục...')
                                ->required()
                                ->maxLength(255),

                            FileUpload::make('image')
                                ->label('Ảnh danh mục')
                                ->image()
                                ->directory('categories')
                                ->visibility('public')
                                ->required(),
                        ]),

                    Textarea::make('description')
                        ->label('Mô tả')
                        ->placeholder('Nhập mô tả cho danh mục...')
                        ->rows(4)
                        ->maxLength(1000),
                ]),
        ]);
}

   public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('id')
                ->label('ID')
                ->sortable()
                ->searchable(),

            TextColumn::make('name')
                ->label('Name category')
                ->sortable()
                ->searchable(),

           ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')    
                    ->visibility('public'), 

            TextColumn::make('description')
                ->label('description')
                ->limit(50),
        ])
        ->filters([
            // Thêm bộ lọc tại đây nếu cần
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
