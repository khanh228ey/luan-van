<?php

namespace App\Http\Controllers;

use App\Models\User;
use Flasher\Laravel\Facade\Flasher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function index(Request $request)
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->input('email_or_phone'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $loginField => $request->input('email_or_phone'),
            'password' => $request->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
        return redirect()->back();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('page.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);
        if ($request->input('password') !== $request->input('password_confirmation')) {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu xác nhận không khớp.']);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 1; // Role mặc định là người dùng
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();
        return redirect()->route('page.login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }


    public function profile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('page.login');
        }
        $addresses = $user->address()->get(); // Giữ nguyên tên hàm address()
        return view('pages.profile', compact('user', 'addresses'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('page.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
            'detail' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->updated_at = now();
        $user->save();

        // Cập nhật hoặc tạo mới địa chỉ (1-1)
        $address = $user->address()->first();
        if (!$address) {
            $address = new \App\Models\Address();
            $address->user_id = $user->id;
        }
        $address->detail = $request->input('detail');
        $address->province = $request->input('province');
        $address->district = $request->input('district');
        $address->ward = $request->input('ward');
        $address->updated_at = now();
        if (!$address->exists) {
            $address->created_at = now();
        }
        $address->save();

        return redirect()->route('auth.profile');
    }
}
// End of file: app/Http/Controllers/AuthController.php