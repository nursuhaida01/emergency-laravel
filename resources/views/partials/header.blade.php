<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลผู้ใช้งานระบบ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        nav {
            width: 200px;
            background-color: #000099;
            position: fixed;
            height: 100vh;
            overflow: auto;
            border-radius: 0 30px 0 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        header {
            background-color: #fff;
            color: #4f4e4e;
            padding: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            width: calc(100% - 200px);
            position: fixed;
            left: 200px;
            top: 0;
            z-index: 1;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo-container img {
            width: 35px;
            height: auto;
            border-radius: 50%;
            margin-right: 10px;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info img {
            width: 35px;
            height: auto;
            border-radius: 50%;
            margin-right: 10px;
        }
        .user-info .username {
            margin-right: 15px;
        }
        nav ul {
            padding: 0;
            margin: 0;
        }
        nav ul li a {
            display: block;
            color: white;
            text-align: left;
            font-size: 14px;
            padding: 10px 15px;
            text-decoration: none;
        }
        nav ul li a i {
            font-size: 12px;
            margin-right: 8px;
        }
        nav ul li a.active {
            margin-top: 1px;
        }
        li a.active, li a:hover {
            background-color: #5353ac;
            color: white;
        }
        nav ul.logout {
            margin-top: auto;
        }
        section {
            margin-left: 220px;
            padding: 15px;
        }
        #rcorners2 {
            border-radius: 25px;
            border: 1px solid #d9d9d9;
            padding: 20px;
            width: 100%;
            margin-top: 70px;
            background-color: #fff;
        }
        nav ul li {
            padding: 1px;
            text-align: left;
            border-bottom: 1px solid #000099;
        }
        #rcorners1 {
            border-radius: 25px;
            background: #73AD21;
            padding: 20px;
            width: 110px;
            height: 40px;
        }
        .navbar.nav_title {
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .navbar.nav_title img {
            width: 40px;
            height: 40px;
            border-radius: 70%;
            margin-right: 10px;
        }
        .nav.child_menu li a {
            color: #f4f4f4;
            font-size: 14px;
            padding: 10px;
            margin-left: 20px;
        }
        .nav.child_menu li a:hover {
            background: #9999ff;
            color: #FFF;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <h1 style="margin: 0; font-size: 18px;">มูลนิธิแม่กอเหนี่ยวยะลา</h1>
        </div>
        <div class="user-info">
            <?php if (isset($user) && isset($user['username'])): ?>
                <span class="username"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
            <img src="user.jpg" alt="user">
        </div>
    </header>
    <nav>
        <div class="navbar nav_title">
            <img src="logo.jpg" />
            <span>ยินดีต้อนรับเข้าสู่ระบบ</span>
        </div>
        <ul>
            <li><a class="active1" href="home.php"><i class="fas fa-user"></i> หน้าหลัก</a></li>
            <li><a class="active1" href="show_users.php"><i class="fas fa-user"></i> ข้อมูลผู้ใช้งานระบบ</a></li>
            <li>
                <a class="active1" href="incident.php">
                    <i class="fas fa-bell"></i> รายการแจ้งเหตุ
                    <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="succed.php">เสร็จสิ้นภารกิจ</a></li>
                    <li><a href="status.php">อัพเดทสถานะ</a></li>
                </ul>
            </li>
            <li><a href="accident.php"><i class="fas fa-book"></i> บันทึกเหตุ</a></li>
            <li>
                <a href="#news"><i class="fas fa-info-circle"></i> บริการ 
                <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="#news">ข่าวสาร</a></li>
                    <li><a href="status.php">สาระเรียนรู้</a></li>
                </ul>
            </li>
            <li><a href="contact.php"><i class="fas fa-info-circle"></i> About</a></li>
        </ul>
        <ul class="logout">
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></li>
        </ul>
    </nav>
   
</body>
</html>
