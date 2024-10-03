<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เพิ่มข้อมูลสมาชิก</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">
    <div style="margin-left: 200px; padding: 20px;">
        <div id="rcorners2">
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-5" align="left">
                    <h4>เพิ่มข้อมูลสมาชิก</h4>
                    @if (session('error'))
                        <p style="color:red;">{{ session('error') }}</p>
                    @endif
                    @if (session('success'))
                        <p style="color:green;">{{ session('success') }}</p>
                    @endif
                    <form action="{{ route('save-member') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-2" align="right">ชื่อ-สกุล:</div>
                            <div class="col-sm-5" align="left">
                                <input name="username" type="text" required class="form-control" id="username" placeholder="ชื่อสกุล" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2" align="right">อีเมล์:</div>
                            <div class="col-sm-5" align="left">
                                <input name="email" type="email" required class="form-control" id="email" placeholder="อีเมล์" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2" align="right">รหัสผ่าน:</div>
                            <div class="col-sm-5" align="left">
                                <input name="password" type="password" required class="form-control" id="password" placeholder="รหัสผ่าน" pattern="^[a-zA-Z0-9]+$" minlength="5" maxlength="20" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2" align="right">ยืนยันรหัสผ่าน:</div>
                            <div class="col-sm-5" align="left">
                                <input name="confirm_password" type="password" required class="form-control" id="confirm_password" placeholder="ยืนยันรหัสผ่าน" pattern="^[a-zA-Z0-9]+$" minlength="5" maxlength="20" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2" align="right">เบอร์โทร:</div>
                            <div class="col-sm-5" align="left">
                                <input name="phone" type="tel" class="form-control" id="phone" placeholder="เบอร์โทร" oninput="validatePhone(this)" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_type" class="col-sm-2 col-form-label text-right">ประเภทผู้ใช้งาน:</label>
                            <div class="col-sm-5">
                                <select name="user_type" class="form-control" id="user_type">
                                    <option value="admin">ผู้ดูแลระบบ</option>
                                    <option value="editor">บรรณาธิการ</option>
                                    <option value="viewer">ผู้ชม</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-primary" id="btn">บันทึก</button>
                                <a onclick="goBack()" class="btn btn-danger">ยกเลิก</a>
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

    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>
