<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <br>
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center my-2" > <!-- เพิ่ม margin -->
        <div class="sidebar-brand-icon mb-2"> <!-- เพิ่ม margin ด้านล่าง -->
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-icon">
        </div>
        <div class="sidebar-brand-text text-uppercase mx-3">ยินดีต้อนรับเข้าสู่ระบบ</div>
       
    </a>
    
    <hr class="sidebar-divider my-0  my-2"> <!-- เพิ่ม margin-top -->
    

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-home"></i>
            <span>หน้าหลัก</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Nav Item - Status Tracking -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('incident.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>รายการแจ้งเหตุ</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">รายการแจ้งเหตุ</div>

    <!-- Collapse Menu Item -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages1" aria-expanded="false" aria-controls="collapsePages1">
            <i class="fas fa-fw fa-folder"></i>
            <span>ข้อมูล</span>
            <i class="fas fa-chevron-down float-right"></i> 
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">รายการแจ้งเหตุ</h6>
                <a class="collapse-item" href="{{ route('incident.progress') }}">รายการกำลังดำเนินการ</a>
                <a class="collapse-item" href="{{ route('incident.completed') }}">เสร็จสิ้นภารกิจ</a>
                <a class="collapse-item" href="{{ route('accident') }}">รายงาน</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('operations.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>บันทึกการปฏิบัติการ</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">รายการ</div>

    <!-- Collapse Menu Item -->
    <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages2" aria-expanded="false" aria-controls="collapsePages2">
            <i class="fas fa-fw fa-folder"></i>
            <span>เพิ่มข้อมูล</span>
            <i class="fas fa-chevron-down float-right"></i> 
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages2" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">เพิ่มข้อมูล</h6>
                <a class="collapse-item" href="{{ route('learning-resources.create') }}">อัปเดทสาระเรียนรู้</a>
                <a class="collapse-item" href="{{ route('news.create') }}">อัปเดทข่าว</a>
                <a class="collapse-item" href="{{ route('member.index') }}">เพิ่มผู้ใช้งานระบบ</a>
            </div>
        </div>
    </li>

    <!-- About -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('contacts.index') }}">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>About</span>
        </a>
    </li>
</ul>
<style>.nav-item .nav-link {
    color: #fff; /* สีปกติของลิงก์ */
    padding: 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease; /* ทำให้การเปลี่ยนแปลงสีลื่นไหล */
}

.nav-item .nav-link:hover {
    background-color: #10197c; /* สีพื้นหลังเมื่อ hover */
  
}

</style>


