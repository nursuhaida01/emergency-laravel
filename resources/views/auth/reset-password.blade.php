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
        width: 60px; /* Adjusted size for logo */
        display: block;
        margin: 0 auto;
    }
    .text-center {
        color: #0080ff;
    }
    @media (min-width: 500px) {
        .col-md-6 {
            max-width: 450px;
        }
    }
    @media (max-width: 500px) {
        .card {
            padding: 15px;
        }
        .logo img {
            width: 80px;
        }
    }
</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-10">
            <div class="card p-4">
                <div class="text-center mb-4 logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
                </div>
                <h6 class="text-center">รีเซ็ตรหัสผ่าน</h6>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="reset-password-form" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="password" class="form-label">รหัสผ่าน</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="รหัสผ่าน">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">ยืนยันรหัสผ่าน</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="ยืนยันรหัสผ่าน">
                    </div>

                    <div class="mb-3">
                        <ul style="font-size: 14px; color: #6c757d;">
                            <li>ต้องมีอักษรภาษาอังกฤษ ตัวพิมพ์เล็กและตัวพิมพ์ใหญ่ อย่างน้อย 8 ตัว</li>
                            <li>ต้องมีตัวอักษรภาษาอังกฤษอย่างน้อย 1 ตัว</li>
                            <li>ต้องมีอักขระพิเศษอย่างน้อย 1 ตัว (เช่น * # @ % +)</li>
                            <li>ต้องมีตัวเลขอย่างน้อย 1 ตัว</li>
                        </ul>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">รีเซ็ต</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="resetPasswordSuccessModal" tabindex="-1" aria-labelledby="resetPasswordSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="resetPasswordSuccessModalLabel">รีเซ็ตรหัสผ่านสำเร็จแล้ว!</h5>
            </div>
            <div class="modal-body">
                <p>ระบบจะนำคุณไปยังหน้าล็อกอินภายใน 5 วินาที</p>
                <a href="{{ route('user.login') }}" class="btn btn-primary">เข้าสู่ระบบทันที</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('reset-password-form').addEventListener('submit', function () {
        // Form will be submitted normally, no preventDefault here

        // After form submission and response from the server, show the modal
        // You may need to move this logic to your backend to ensure the password was successfully updated
        var successModal = new bootstrap.Modal(document.getElementById('resetPasswordSuccessModal'));
        successModal.show();

        // Redirect to login after 5 seconds
        setTimeout(function () {
            window.location.href = "{{ route('user.login') }}";
        }, 5000); // 5 seconds
    });
</script>
</body>
</html>
