<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function addCart(Request $request)
    {
        $userId = Auth::id(); // Lấy ID người dùng đã đăng nhập

        if (!$userId) {
            return response()->json(['message' => 'Bạn cần đăng nhập trước.'], 401);
        }

        $productDetailId = $request->input('product_detail_id');
        $productId = $request->input('product_id');
        if (!$productDetailId) {
            return response()->json(['message' => 'Thiếu product_detail_id.'], 400);
        }
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_detail_id', $productDetailId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_detail_id' => $productDetailId,
                'quantity' => 1,
                'product_id' => $productId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('cart.view')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function viewCart()
    {
        return view('pages.cart');
    }

    public function deleteCart(Request $request)
    {
        $userId = Auth::id(); // Lấy ID người dùng đã đăng nhập

        if (!$userId) {
            return response()->json(['message' => 'Bạn cần đăng nhập trước.'], 401);
        }

        $cartItemId = $request->input('cart_item_id');

        if (!$cartItemId) {
            return response()->json(['message' => 'Thiếu cart_item_id.'], 400);
        }

        $cartItem = Cart::where('user_id', $userId)->where('id', $cartItemId)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm trong giỏ hàng.'], 404);
        }

        $cartItem->delete();

        return redirect()->route('cart.view')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
    public function updateQuantity(Request $request, $id)
    {
        $userId = Auth::id();
        $quantity = $request->input('quantity');
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập trước.'], 401);
        }
        $cartItem = \App\Models\Cart::where('user_id', $userId)->where('id', $id)->first();
        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng.'], 404);
        }
        if ($quantity < 1) {
            return response()->json(['success' => false, 'message' => 'Số lượng tối thiểu là 1.'], 400);
        }
        $cartItem->quantity = $quantity;
        $cartItem->save();
        return response()->json(['success' => true, 'message' => 'Cập nhật số lượng thành công.']);
    }


    public function pageCheckout(Request $request)
    {
        $userId = Auth::id();
        $cartItemIds = $request->input('cart_item_ids', []);

        // Nếu không chọn sản phẩm nào thì chuyển về giỏ hàng
        if (!$cartItemIds || !is_array($cartItemIds) || count($cartItemIds) == 0) {
            return redirect()->route('cart.view')->with('error', 'Vui lòng chọn sản phẩm để thanh toán.');
        }

        // Lấy các sản phẩm đã chọn của user
        $cartItems = \App\Models\Cart::with(['product', 'product.product_images', 'product.brand'])
            ->where('user_id', $userId)
            ->whereIn('id', $cartItemIds)
            ->get();

        // Tính tổng tiền
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('pages.checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }
}
