
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
    <a style="margin-left: 5px; font-size: 18px; color: #100263">มูลนิธิแม่กอเหนี่ยวยะลา</a>
   
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1"></li>
    
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (Auth::guard('member')->check())
               Admin <span class="username">{{ Auth::guard('member')->user()->username }}</span>
            @endif
            
                <img class="img-profile rounded-circle" src="{{ asset('images/user.jpg') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">คุณแน่ใจที่จะออกจากระบบหรือไหม?</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                "เลือก 'ออกจากระบบ' ด้านล่างหากคุณพร้อมที่จะสิ้นสุดการใช้งานในครั้งนี้"
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">ยกเลิก</button>
                <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ออกจากระบบ</button>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
