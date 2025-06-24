<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required', // sẽ là 0 nếu COD
            'total' => 'required|numeric',
            'shipping_fee' => 'required|numeric',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'detail' => 'required|string',
            'cart_item_ids' => 'required|array',
            'cart_item_ids.*' => 'integer',
            'product_detail_ids' => 'required|array',
            'product_detail_ids.*' => 'integer',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }

        $grandTotal = $request->input('total') + $request->input('shipping_fee');

        $order = Order::create([
            'user_id' => $userId,
            'status' => $request->input('status', 0),
            'payment_method' => intval($request->input('payment_method', 0)),
            'payment_status' => $request->input('payment_status', 0),
            'total' => $grandTotal,
            'province' => $request->input('province'),
            'district' => $request->input('district'),
            'ward' => $request->input('ward'),
            'detail' => $request->input('detail'),
            'note' => $request->input('note', ''),
        ]);

        $cartItemIds = $request->input('cart_item_ids', []);
        $productDetailIds = $request->input('product_detail_ids', []);
        $quantities = $request->input('quantities', []);

        foreach ($cartItemIds as $cartItemId) {
            $productDetailId = $productDetailIds[$cartItemId] ?? null;
            $quantity = $quantities[$cartItemId] ?? 1;
            if ($productDetailId) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_detail_id' => $productDetailId,
                    'quantity' => $quantity,
                ]);
            }
        }

        // Xóa các mục trong giỏ hàng sau khi đặt hàng thành công
        foreach ($cartItemIds as $cartItemId) {
            $productDetailId = $productDetailIds[$cartItemId] ?? null;
            if ($productDetailId) {
                // Giả sử bạn có một phương thức để xóa mục giỏ hàng
                Cart::where('user_id', $userId)
                    ->where('product_detail_id', $productDetailId)
                    ->delete();
            }
        }

        return view('pages.order_susscess', [
            'order' => $order,
        ])->with('success', 'Đặt hàng thành công!');
    }
}
