<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //


    public function getVoucher($code)
    {
        $voucher = Voucher::where('code', $code)->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Voucher không tồn tại'], 404);
        }

        if ($voucher->quantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Voucher đã hết lượt sử dụng'], 400);
        }

        $now = now('Asia/Ho_Chi_Minh');
        if ($voucher->start_date && $now->lt($voucher->start_date)) {
            return response()->json(['success' => false, 'message' => 'Voucher chưa đến thời gian sử dụng'], 400);
        }
        if ($voucher->end_date && $now->gt($voucher->end_date)) {
            return response()->json(['success' => false, 'message' => 'Voucher đã hết hạn'], 400);
        }

        return response()->json([
            'success' => true,
            'voucher' => $voucher,
            'message' => 'Áp dụng voucher thành công'
        ]);
    }
}
