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
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Card::make()
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')
                                ->label('Tên sản phẩm')
                                ->required()
                                ->maxLength(255),

                            Select::make('category_id')
                                ->label('Danh mục')
                                ->relationship('category', 'name')
                                ->required(),

                            Select::make('brand_id')
                                ->label('Thương hiệu')
                                ->relationship('brand', 'name')
                                ->required(),
                        ]),

                    Textarea::make('description')
                        ->label('Mô tả')
                        ->rows(4)
                        ->maxLength(2000),

                    Card::make()->schema([
    // ... các field khác (name, category_id, brand_id, description, v.v)

    \Filament\Forms\Components\Group::make()
        ->relationship('product_images') // 
        ->schema([
            Grid::make(2)->schema([
                FileUpload::make('image1')
                    ->label('Ảnh 1')
                    ->image()
                    ->directory('products/images')
                    ->visibility('public'),

                FileUpload::make('image2')
                    ->label('Ảnh 2')
                    ->image()
                    ->directory('products/images')
                    ->visibility('public'),

                FileUpload::make('image3')
                    ->label('Ảnh 3')
                    ->image()
                    ->directory('products/images')
                    ->visibility('public'),

                FileUpload::make('image4')
                    ->label('Ảnh 4')
                    ->image()
                    ->directory('products/images')
                    ->visibility('public'),
            ])
        ])
]),
                    Repeater::make('product_details')
                        ->label('Biến thể sản phẩm')
                        ->relationship()
                        ->schema([
                            TextInput::make('size')
                                ->required()
                                ->maxLength(20),
                            TextInput::make('color')
                                ->required()
                                ->maxLength(30),
                            TextInput::make('price')
                                ->numeric()
                                ->required(),
                            TextInput::make('prince_sales')
                                ->label('Giá khuyến mãi')
                                ->numeric(),
                            TextInput::make('quantity')
                                ->numeric()
                                ->required(),
                            FileUpload::make('image')
                                ->image()
                                ->directory('products/variants')
                                ->visibility('public')
                                ->label('Ảnh biến thể'),
                        ])
                        ->columns(3)
                        ->minItems(1)
                        ->createItemButtonLabel('Thêm biến thể'),
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
                ->label('Product Name')
                ->sortable()
                ->searchable(),
            TextColumn::make('description')
                ->label('Description')
                ->limit(50) // Giới hạn hiển thị mô tả
                ->wrap(),    // Cho phép xuống dòng nếu dài
        ])
        ->filters([
            // Thêm filter nếu cần
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
