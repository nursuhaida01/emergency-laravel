<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลสมาชิก</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            margin-top: 50px;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            margin-bottom: 30px;
            font-weight: bold;
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .alert {
            padding: 10px 15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h5 class="form-title text-center">สมัครสมาชิก</h5>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
    
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
    
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label text-right">ชื่อ-สกุล:</label>
                        <div class="col-sm-8">
                            <input name="username" type="text" required class="form-control" id="username" placeholder="ชื่อสกุล">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-right">อีเมล์:</label>
                        <div class="col-sm-8">
                            <input name="email" type="email" required class="form-control" id="email" placeholder="อีเมล์">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label text-right">รหัสผ่าน:</label>
                        <div class="col-sm-8">
                            <input name="password" type="password" required class="form-control" id="password" placeholder="รหัสผ่าน" pattern="^[a-zA-Z0-9]+$" minlength="5" maxlength="20">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-4 col-form-label text-right">ยืนยันรหัสผ่าน:</label>
                        <div class="col-sm-8">
                            <input name="password_confirmation" type="password" required class="form-control" id="password_confirmation" placeholder="ยืนยันรหัสผ่าน" pattern="^[a-zA-Z0-9]+$" minlength="5" maxlength="20">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-4 col-form-label text-right">เบอร์โทร:</label>
                        <div class="col-sm-8">
                            <input name="phone" type="tel" class="form-control" id="phone" placeholder="เบอร์โทร" oninput="validatePhone(this)">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4 d-flex">
                            <button type="submit" class="btn btn-primary mr-2">สมัครสมาชิก</button>
                            <button type="button" class="btn btn-secondary" onclick="goBack()">ยกเลิก</button>
                        </div>
                    </div>
                    <!-- ทำให้ข้อความตรงกลาง -->
                    <p class="forgot-password-link text-center"><a href="{{ route('user.login') }}">ล็อกอินเข้าสู่ระบบ</a></p>
                </form>
                
                  
                </div>
            </div>
        </div>
    </div>

    <script>
        function validatePhone(input) {
            var phoneValue = input.value;
            if (!/^[0-9]*$/.test(phoneValue)) {
                alert("กรุณากรอกเฉพาะตัวเลขเท่านั้น");
                input.value = ""; // ลบค่าที่ป้อนเข้าไป
            }
        }

        function goBack() {
            window.history.back();
        }
    </script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
