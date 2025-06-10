<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Card;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\ProductDetail;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('user_id')
                        ->label('Người đặt hàng')
                        ->relationship('user', 'name')
                        ->preload()
                        ->searchable()
                        ->required(),

                    Select::make('status')
                        ->label('Trạng thái đơn hàng')
                        ->required()
                        ->options([
                            'pending' => 'Chờ xác nhận',
                            'confirmed' => 'Đã xác nhận',
                            'shipping' => 'Đang giao hàng',
                            'delivered' => 'Đã giao hàng',
                        ]),

                    Select::make('payment_method')
                        ->label('Phương thức thanh toán')
                        ->required()
                        ->options([
                            'online' => 'Thanh toán online',
                            'cod' => 'Thanh toán khi nhận hàng',
                        ]),

                    Select::make('payment_status')
                        ->label('Tình trạng thanh toán')
                        ->required()
                        ->options([
                            'paid' => 'Đã thanh toán',
                            'unpaid' => 'Chưa thanh toán',
                        ]),
                ]),

                Card::make()->schema([
                    Repeater::make('order_items')
                        ->relationship('orderItems')
                        ->label('Sản phẩm trong đơn hàng')
                        ->schema([
                            // Chọn sản phẩm
                            Select::make('product_id')
                                ->label('Sản phẩm')
                                ->relationship('product', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->reactive() // Bắt buộc để dùng cho Select phụ thuộc
                                ->afterStateUpdated(fn($state, Set $set) => $set('product_detail_id', null)),

                            // Chọn biến thể theo sản phẩm
                            Select::make('product_detail_id')
                                ->label('Biến thể sản phẩm')
                                ->options(function (Get $get) {
                                    $productId = $get('product_id');
                                    if (!$productId) return [];

                                    return ProductDetail::where('product_id', $productId)
                                        ->get()
                                        ->mapWithKeys(function ($detail) {
                                            return [
                                                $detail->id => "{$detail->color} - {$detail->size} - {$detail->price}₫"
                                            ];
                                        });
                                })
                                ->required()
                                ->searchable()
                                ->preload(),

                            TextInput::make('quantity')
                                ->label('Số lượng')
                                ->numeric()
                                ->required(),

                        ])
                        ->columns(3)
                        ->createItemButtonLabel('Thêm sản phẩm')
                        ->minItems(1),
                ]),
                TextColumn::make('total')
                    ->label('Tổng tiền')
                    ->money('VND', true)
                    ->getStateUsing(fn($record) => $record->total)
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
