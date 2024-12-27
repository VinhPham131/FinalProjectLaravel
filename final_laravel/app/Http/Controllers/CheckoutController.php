<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCheckoutStep($step)
    {
         // Kiểm tra bước hợp lệ
         if (!in_array($step, [1, 2, 3])) {
            abort(404); // Nếu bước không tồn tại, trả về lỗi 404
        }

        // Trả về view với bước hiện tại
        return view('checkout', ['step' => $step]);
    }

    public function processStep(Request $request, $step)
{
    // Kiểm tra xem bước hiện tại có hợp lệ không
    if (!in_array($step, [1, 2, 3])) {
        abort(404); // Nếu bước không hợp lệ, trả về lỗi 404
    }

    $nextStep = $step; // Mặc định giữ nguyên bước hiện tại

    // Xử lý từng bước
    switch ($step) {
        case 1:
            // Xử lý dữ liệu cho Step 1: Personal Info
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            // Lưu thông tin vào session
            session([
                'checkout.name' => $validated['name'],
                'checkout.email' => $validated['email'],
            ]);

            // Nếu dữ liệu hợp lệ, tăng bước
            $nextStep = 2;
            break;

        case 2:
            // Xử lý dữ liệu cho Step 2: Order Info
            $validated = $request->validate([
                'delivery_address' => 'required|string|max:255',
                'contact_number' => 'required|string|max:15',
            ]);

            // Lưu thông tin vào session
            session([
                'checkout.delivery_address' => $validated['delivery_address'],
                'checkout.contact_number' => $validated['contact_number'],
            ]);

            // Nếu dữ liệu hợp lệ, tăng bước
            $nextStep = 3;
            break;

        case 3:
            // Bước 3: Confirmation không cần validate thêm
            break;

        default:
            abort(404); // Trả về lỗi nếu bước không hợp lệ
    }

    // Kiểm tra nếu là bước cuối, chuyển đến trang hoàn tất
    if ($nextStep > 3) {
        return redirect()->route('checkout.complete');
    }

    // Chuyển đến bước tiếp theo
    return redirect()->route('checkout.step', ['step' => $nextStep]);
}

}

