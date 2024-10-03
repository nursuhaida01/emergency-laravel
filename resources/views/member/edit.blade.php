@extends('layouts.web')

@section('content')
<div class="container mt-5">
    <h1 class="h3 mb-2 text-gray-800">แก้ไขข้อมูลสมาชิก</h1>

                    @if (session('error'))
                        <p style="color:red;">{{ session('error') }}</p>
                    @endif
                    @if (session('success'))
                        <p style="color:green;">{{ session('success') }}</p>
                    @endif
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูลสมาชิก</h6>
                        </div>
                        <div class="card-body">
                    <form action="{{ route('member.update', $member->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-4" align="right">ชื่อ-สกุล:</div>
                            <div class="col-sm-5" align="left">
                                <input name="username" type="text" required class="form-control" id="username" value="{{ $member->username }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4" align="right">อีเมล์:</div>
                            <div class="col-sm-5" align="left">
                                <input name="email" type="email" required class="form-control" id="email" value="{{ $member->email }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4" align="right">รหัสผ่าน:</div>
                            <div class="col-sm-5" align="left">
                                <input name="password" type="password" class="form-control" id="password" placeholder="เว้นว่างหากไม่ต้องการเปลี่ยนแปลง" pattern="^[a-zA-Z0-9]+$" minlength="5" maxlength="20" />
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4" align="right">เบอร์โทร:</div>
                            <div class="col-sm-5" align="left">
                                <input name="phone" type="tel" class="form-control" id="phone" value="{{ $member->phone }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_type" class="col-sm-4 col-form-label text-right">ประเภทผู้ใช้งาน:</label>
                            <div class="col-sm-5">
                                <select name="user_type" class="form-control" id="user_type">
                                    <option value="ผู้ดูแลระบบ" {{ $member->user_type == 'ผู้ดูแลระบบ' ? 'selected' : '' }}>ผู้ดูแลระบบ</option>
                                    <option value="พนักงาน" {{ $member->user_type == 'พนักงาน' ? 'selected' : '' }}>พนักงาน</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                <a href="{{ route('member.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            </div>
                        </div>
                    </form>
                </div>
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
</script>

@endsection
