
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลผู้ใช้งานระบบ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
      
        nav {
            background-color: #111;
            float: left;
            width: 200px;
            height: 100%;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 8px 14px;
            text-decoration: none;
        }
        li a.active {
            background-color: #5353ac;
            margin-top: 40px;
        }
        section {
            margin-left: 20px;
            padding: 18px;
        }
        #rcorners2 {
            border-radius: 25px;
            border: 1px solid #d9d9d9;
            padding: 20px;
            width: 100%;
            margin-top: 70px; /* เพิ่มระยะห่างจากด้านบน */
        }
        nav ul li {
            padding: 5px;
            text-align: center;
            border-bottom: 1px solid 000099;
        }
        .table-container {
            margin-top: 20px;
        }
        .table-container .row > div {
            padding: 10px;
            text-align: center;
        }
        .table-container .row:nth-child(even) > div {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div style="margin-left: 200px; padding: 20px;">
        <div id="rcorners2">
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-5" align="left">
                    <h4>เพิ่มข้อมูลสมาชิก</h4>
                    <?php
                    if (isset($error)) {
                        echo "<p style='color:red;'>$error</p>";
                    }
                    if (isset($success)) {
                        echo "<p style='color:green;'>$success</p>";
                    }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input name="Admin_level" type="hidden" id="Admin_level" value="2" />
                    </div>
                </div>
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
                        <input name="password" type="password" required class="form-control" id="password" placeholder="password" pattern="^[a-zA-Z0-9]+$" minlength="5" maxlength="20" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2" align="right">ยืนยันรหัสผ่าน:</div>
                    <div class="col-sm-5" align="left">
                        <input name="confirm_password" type="password" required class="form-control" id="confirm_password" placeholder="confirm_password" pattern="^[a-zA-Z0-9]+$" minlength="5" maxlength="20" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2" align="right">เบอร์โทร:</div>
                    <div class="col-sm-5" align="left">
                        <input name="phone" type="tel" class="form-control" id="phone" placeholder="เบอร์โทร" oninput="validatePhone(this)" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mem_type" class="col-sm-2 col-form-label text-right">ประเภทผู้ใช้งาน:</label>
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
                        <a onclick="goback()" name="goback" class="btn btn-danger" id="btn">ยกเลิก</a>
                        <script>
                            function goback() {
                                window.location.href = "../mdsport/login.php";
                            }
                        </script>
                    </div>
                </div>
            </form>
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
</body>
</html>
