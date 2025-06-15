<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập & Đăng ký</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            width: 360px;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .tab {
            display: flex;
            margin-bottom: 20px;
        }

        .tab label {
            flex: 1;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            background: #eee;
            border-radius: 8px 8px 0 0;
            font-weight: 600;
            transition: 0.3s;
        }

        .tab input {
            display: none;
        }

        #login:checked~.form-container .login-form,
        #register:checked~.form-container .register-form {
            display: block;
        }

        #login:checked~.tab label[for="login"],
        #register:checked~.tab label[for="register"] {
            background: #fff;
            border-bottom: 2px solid #3498db;
        }

        .form-container form {
            display: none;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }

        form input:focus {
            border-color: #3498db;
            outline: none;
        }

        form button {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        form button:hover {
            background: #2980b9;
        }

        .form-footer {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <input type="radio" id="login" name="tab" checked>
        <input type="radio" id="register" name="tab">

        <div class="tab">
            <label for="login">Đăng nhập</label>
            <label for="register">Đăng ký</label>
        </div>

        <div class="form-container">
            <!-- Form Đăng nhập -->
            <form class="login-form" action="{{ route('auth.login') }}" method="POST">
                @csrf
                <input type="text" name="email_or_phone" placeholder="Email hoặc số điện thoại" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <button type="submit">Đăng nhập</button>
                <div class="form-footer">Quên mật khẩu?</div>
            </form>

            <!-- Form Đăng ký -->
            <form class="register-form" action="{{ route('auth.register') }}" method="POST">
                @csrf
                <input type="text" placeholder="Họ và tên" name="name" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="tel" placeholder="Số điện thoại" name="phone" required>
                <input type="password" placeholder="Mật khẩu" name="password" required>
                <input type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation" required>
                <button type="submit">Đăng ký</button>
                <div class="form-footer">Đã có tài khoản? Đăng nhập!</div>
            </form>
        </div>
    </div>

</body>

</html>
