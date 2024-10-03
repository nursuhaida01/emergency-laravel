<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  
  <!-- MDB CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <style>
    .vh-100 {
      height: 100vh;
    }
    .h-custom {
      height: calc(100% - 73px);
    }
    .card-custom {
      border-radius: 8px;
      border: 1px solid #007bff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .form-outline input {
      border-radius: 5px;
    }
    .form-outline label {
      margin-bottom: 0;
    }
    .btn-primary-custom {
      padding-left: 2.5rem;
      padding-right: 2.5rem;
    }
    .container-custom {
      max-width: 500px;
      padding: 20px;
      margin: auto;
    }
  </style>
</head>
<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5 d-none d-md-block">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <div class="container-custom">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      
            <form action="{{ route('user.login') }}" method="POST">
              @csrf
              <div class="card card-custom mb-4">
                <div class="card-header card-header-custom text-center">
                  <h5 class="card-title">ลงชื่อเข้าสู่ระบบ</h5>
                </div>
                <div class="card-body">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                      placeholder="Enter a valid email address" required/>
                    <label class="form-label" for="email">Email address</label>
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-3">
                    <input type="password" id="password" name="password" class="form-control form-control-lg"
                      placeholder="Enter password" required/>
                    <label class="form-label" for="password">Password</label>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                      <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                      <label class="form-check-label" for="form2Example3">
                        Remember me
                      </label>
                    </div>
                    <a href="{{ route('password.forgot') }}" class="text-body">ลืมรหัสผ่าน?</a>
                  </div>

                  <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg btn-primary-custom">Login</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">สร้างบัญชีเข้าสู่ระบบ <a href="{{ route('register') }}"
                        class="link-danger">Register</a></p>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- MDB JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
