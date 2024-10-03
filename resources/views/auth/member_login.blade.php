<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #3a0ca3, #072ac8, #edf6f9, #ffffff, #ffffff);
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height: 100vh;
            padding-right: 20px;
        }

        .container {
            max-width: 400px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body>
<div class="d-flex justify-content-end align-items-center vh-100 justify-content-center">
    <div class="bg-white p-5 rounded-5 shadow ms-auto" style="margin-right: 180px;">
        <div class="text-center">
            <img src="{{ asset('images/logo.jpg') }}"  class="img-fluid" style="width: 100px;" alt="Logo">
            <h3 class="card-title">มูลนิธิแม่กอเหนียวยะลา</h3>
          
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          
            <form action="{{ route('member.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input id="email" name="email" class="form-control bg-light" type="email" placeholder="Email" required>
                    <span id="emailError" class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <input id="password" name="password" class="form-control bg-light" type="password" placeholder="Password" required>
                    <span id="passwordError" class="invalid-feedback"></span>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" name="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
</body>
</html>
