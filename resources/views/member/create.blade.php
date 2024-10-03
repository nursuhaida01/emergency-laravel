@extends('layouts.backend')

@section('content')

  
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ฟอร์มสมัครสมาชิก</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('member.store') }}" method="POST">
                @csrf

                <div class="form-group row">
                    <label for="username" class="col-sm-4 text-right">ชื่อ-สกุล:</label>
                    <div class="col-sm-5">
                        <input name="username" type="text" required class="form-control" id="username" placeholder="ชื่อสกุล" value="{{ old('username') }}" />
                        @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-4 text-right">อีเมล์:</label>
                    <div class="col-sm-5">
                        <input name="email" type="email" required class="form-control" id="email" placeholder="อีเมล์" value="{{ old('email') }}" />
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-4 text-right">รหัสผ่าน:</label>
                    <div class="col-sm-5">
                        <input name="password" type="password" required class="form-control" id="password" placeholder="รหัสผ่าน" />
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-4 text-right">เบอร์โทร:</label>
                    <div class="col-sm-5">
                        <input name="phone" type="tel" class="form-control" id="phone" placeholder="เบอร์โทร" value="{{ old('phone') }}" />
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_type" class="col-sm-4 text-right">ประเภทผู้ใช้งาน:</label>
                    <div class="col-sm-5">
                        <select name="user_type" class="form-control" id="user_type">
                            <option value="ผู้ดูแลระบบ" {{ old('user_type') == 'ผู้ดูแลระบบ' ? 'selected' : '' }}>ผู้ดูแลระบบ</option>
                            <option value="พนักงาน" {{ old('user_type') == 'พนักงาน' ? 'selected' : '' }}>พนักงาน</option>
                        </select>
                        @if ($errors->has('user_type'))
                            <span class="text-danger">{{ $errors->first('user_type') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btn">บันทึก</button>
                        <a href="#" onclick="goBack()" class="btn btn-secondary">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>
@endsection
