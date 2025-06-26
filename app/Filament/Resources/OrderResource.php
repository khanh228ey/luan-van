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
                            0 => 'Đang chờ',
                            1 => 'Đã duyệt',
                            2 => 'Đang giao',
                            3 => 'Đã giao hàng',
                            4 => 'Đã huỷ',
                        ]),

                    Select::make('payment_method')
                        ->label('Phương thức thanh toán')
                        ->required()
                        ->options([
                            0 => 'Thanh toán khi nhận hàng',
                            1 => 'Thanh toán online',
                        ]),

                    Select::make('payment_status')
                        ->label('Tình trạng thanh toán')
                        ->required()
                        ->options([
                            0 => 'Chưa thanh toán',
                            1 => 'Đã thanh toán',
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
                TextColumn::make('id')
                    ->label('Mã đơn hàng')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Người đặt hàng')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total')
                    ->label('Tổng tiền')
                    ->money('VND', true)
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $statusArr = [
                            0 => ['label' => 'Đang chờ', 'style' => 'background:#2563eb;color:#fff;'],      // blue-700
                            1 => ['label' => 'Đã duyệt', 'style' => 'background:#6d28d9;color:#fff;'],      // purple-700
                            2 => ['label' => 'Đang giao', 'style' => 'background:#ea580c;color:#fff;'],     // orange-600
                            3 => ['label' => 'Đã giao hàng', 'style' => 'background:#15803d;color:#fff;'],  // green-700
                            4 => ['label' => 'Đã huỷ', 'style' => 'background:#b91c1c;color:#fff;'],        // red-700
                        ];
                        $status = $statusArr[$state] ?? $statusArr[0];
                        return "<span class='badge' style='{$status['style']}'>{$status['label']}</span>";
                    })
                    ->html()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('Phương thức thanh toán')
                    ->formatStateUsing(fn($state) => $state == 0 ? 'Thanh toán khi nhận hàng' : 'Thanh toán online')
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->label('Tình trạng thanh toán')
                    ->formatStateUsing(fn($state) => $state == 0 ? 'Chưa thanh toán' : 'Đã thanh toán')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
