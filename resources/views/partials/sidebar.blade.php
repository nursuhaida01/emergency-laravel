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
    

    <li class="nav-item active">
        <a class="nav-link" href="/Dashboards">
            <i class="fas fa-home"></i>
            <span>หน้าหลัก</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('incident.create') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>แจ้งอุบัติเหตุ</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" >
            <i class="fas fa-fw fa-file-alt"></i>
            <span>รายการแจ้งเหตุ</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('news.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>ข่าวสาร</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <!-- Nav Item - Tables -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('learning-resources.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>สาระเรียนรู้</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('contacts.create') }}">
            <i class="fas fa-fw fa-phone"></i>
            <span>ติดต่อหน่วยงาน</span>
        </a>
    </li>
</ul>
