<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลืมรหัสผ่าน</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #00aaff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .btn-primary {
            background-color: #0080ff;
            border: none;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0070e0;
        }
        .forgot-password-link {
            color: #00aaff;
            text-align: center;
            margin-top: 10px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .logo img {
            width: 80px;
            display: block;
            margin: 0 auto;
        }
        .text-center {
            color: #0080ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="text-center mb-4 logo">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
                    </div>
                    <h4 class="text-center">ลืมรหัสผ่าน</h4>
                    <p class="text-center">รีเซ็ตรหัสผ่านด้วยอีเมลที่ใช้งาน</p>
                    @if (session('error'))
                        <p class="text-danger text-center">{{ session('error') }}</p>
                    @endif
                    @if (session('success'))
                        <p class="text-success text-center">{{ session('success') }}</p>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                        </div>
                        <button type="submit" class="btn btn-primary">ถัดไป</button>
                    </form>
                    <p class="forgot-password-link"><a href="{{ route('user.login') }}">ล็อกอินเข้าสู่ระบบ</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
