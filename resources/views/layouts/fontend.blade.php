<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=PT+Serif:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('fontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontend/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('fontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('fontend/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar start -->
    <div class="container-fluid sticky-top px-0">
        <div class="container-fluid bg-light">
            <div class="container px-0">
                <nav class="navbar navbar-light navbar-expand-xl">
                    <a href="index.html" class="navbar-brand d-flex align-items-center">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-icon"
                            style="height: 40px; margin-right: 10px;">
                        <h1 class="text-primary display-4" style="font-size: 24px;">Accident</h1>
                    </a>

                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
                        <div class="navbar-nav mx-auto border-top">
                            <a href="/Dashboards" class="nav-item nav-link active">หน้าหลัก</a>
                            @auth
                            <a href="{{ route('notifications.index') }}" class="nav-item nav-link">รายการแจ้ง</a>
                        @endauth
                        
                            <a href="service.html" class="nav-item nav-link">บริการ</a>
                            <a href="price.html" class="nav-item nav-link">Price</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">บริการ</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <a href="{{ route('news.frontend') }}" class="dropdown-item">ข่าวสาร</a>
                                    <a href="{{ route('learning-resources.index') }}"
                                        class="dropdown-item">สาระความรู้</a>
                                </div>
                            </div>
                            <a href="{{ route('contacts.create') }}" class="nav-item nav-link">Contact Us</a>
                            @auth
<div class="d-flex justify-content-end align-items-center">
    <div class="notification-icon position-relative dropdown">
        <a href="#" id="alertsDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="decreaseNotificationCount()">
            <i class="fas fa-bell fa-fw"></i>
            <span id="notification-count" class="badge badge-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
             
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow-lg p-3" aria-labelledby="alertsDropdown" style="width: 300px;">
            <h6 class="dropdown-header bg-primary text-white p-2 rounded">ALERTS CENTER</h6>
            @if ($user)
                @php
                    $newIncidents = \App\Models\Incident::where('user_id', $user->id)
                        ->whereIn('status', ['แจ้งเหตุใหม่', 'กำลังดำเนินการ', 'เสร็จสิ้น'])
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
                @endphp
                @foreach ($newIncidents as $incident)
                    <a class="dropdown-item d-flex align-items-center border-bottom mb-2" href="{{ route('incident.showuser', $incident->id) }}" onclick="decreaseNotificationCountByOne()">
                        <div class="mr-3">
                            <div class="icon-circle 
                            @if ($incident->status == 'แจ้งเหตุใหม่') bg-info 
                            @elseif($incident->status == 'กำลังดำเนินการ') bg-warning 
                            @elseif($incident->status == 'เสร็จสิ้น') bg-success 
                            @elseif($incident->status == 'ยกเลิก') bg-danger 
                            @else bg-primary @endif">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $incident->created_at->format('F d, Y H:i') }}</div>
                            <span class="font-weight-bold">{{ $incident->case_number }} </span>
                            <div class="small text-gray-500"> {{ $incident->location }}</div>
                            <p class="mb-0">สถานะ: 
                                @if ($incident->status == 'แจ้งเหตุใหม่')
                                    รอรับเคส
                                @else
                                    {{ $incident->status }}
                                @endif
                            </p>
                        </div>
                    </a>
                @endforeach
            @else
                <p class="dropdown-item">กรุณาเข้าสู่ระบบเพื่อดูการแจ้งเตือน</p>
            @endif
        </div>
    </div>
</div>

<script>
    function decreaseNotificationCount() {
        let notificationCountElement = document.getElementById('notification-count');
        let currentCount = parseInt(notificationCountElement.textContent);
        if (currentCount > 0) {
            notificationCountElement.textContent = currentCount;
        }
    }

    function decreaseNotificationCountByOne() {
        let notificationCountElement = document.getElementById('notification-count');
        let currentCount = parseInt(notificationCountElement.textContent);
        if (currentCount > 0) {
            notificationCountElement.textContent = currentCount - 1;
        }
    }
</script>
@endauth

                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        @auth
                            <!-- If user is authenticated, show the LOGOUT button -->
                            <a href="#" class="btn btn-danger rounded-pill px-3 py-2" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">
                                LOGOUT
                            </a>
                        @else
                            <!-- If user is not authenticated, show the LOGIN button -->
                            <a href="{{ route('user.login') }}" class="btn btn-primary rounded-pill px-4 py-2">
                                LOGIN
                            </a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- โมดัลยืนยันการออกจากระบบ -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">คุณแน่ใจที่จะออกจากระบบหรือไม่?</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    "เลือก 'ออกจากระบบ' ด้านล่างหากคุณพร้อมที่จะสิ้นสุดการใช้งานในครั้งนี้"
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" type="button"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ออกจากระบบ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ฟอร์มสำหรับออกจากระบบ -->
    <form id="logout-form" action="{{ route('logout.user') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Content Start -->
    <div class="container-fluid mt-3">
        @yield('content')
    </div>
    <!-- Content End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-4 text-center text-md-start mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your
                            Site
                            Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-center">
                        <a href="https://www.facebook.com/profile.php?id=100064623012060"
                            class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href=""
                            class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i
                                class="fab fa-twitter"></i></a>
                        <a href=""
                            class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i
                                class="fab fa-instagram"></i></a>
                        <a href=""
                            class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-0"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-4 text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('fontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('fontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('fontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('fontend/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('fontend/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('fontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('fontend/js/main.js') }}"></script>

</body>

<style>
    .sidebar-brand-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo-icon {
        width: 50px;
        height: auto;
        border-radius: 50%;
    }

    .notification-icon {
    font-size: 24px;
    color: #6c757d;
}

.notification-icon .badge {
    font-size: 12px;
    color: white;
    background-color: red;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dropdown-menu {
    width: 300px;
}

.dropdown-header {
    font-size: 16px;
    font-weight: bold;
}

.dropdown-item {
    padding: 10px;
}

.dropdown-item .icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dropdown-item .small {
    color: #6c757d;
    font-size: 12px;
}

.dropdown-item .font-weight-bold {
    font-weight: bold;
    display: block;
    margin-top: 2px;
}

.dropdown-item p {
    margin: 0;
    font-size: 14px;
    color: #333;
}

.dropdown-item:last-child {
    border-bottom: none;
}

.dropdown-item.text-center {
    padding: 10px;
    color: #6c757d;
    font-size: 14px;
    background-color: #f8f9fa;
}
</style>


</html>
