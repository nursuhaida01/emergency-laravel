<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
    <a style="margin-left: 5px; font-size: 18px; color: #100263">มูลนิธิแม่กอเหนี่ยวยะลา</a>
   
    <ul class="navbar-nav ml-auto">
        <!-- Alerts Dropdown -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- ดึงจำนวนการแจ้งเหตุ -->
                @php
                    $user = Auth::guard('web')->user();
                    $newIncidentsCount = 0; // ค่าเริ่มต้นหากผู้ใช้ยังไม่ได้ล็อกอิน
                
                    if ($user) {
                        $newIncidentsCount = \App\Models\Incident::where('user_id', $user->id)
                            ->whereIn('status', ['แจ้งเหตุใหม่', 'กำลังดำเนินการ', 'เสร็จสิ้น'])
                            ->count();
                    }
                @endphp
                
                <span class="badge badge-danger badge-counter">{{ $newIncidentsCount }}</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Alerts Center</h6>
                @if ($user)
                    @php
                        $newIncidents = \App\Models\Incident::where('user_id', $user->id)
                            ->whereIn('status', ['แจ้งเหตุใหม่', 'กำลังดำเนินการ', 'เสร็จสิ้น'])
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                 @foreach ($newIncidents as $incident)
                 <a class="dropdown-item d-flex align-items-center" >
                     <div class="mr-3">
                         <div class="icon-circle 
                             @if($incident->status == 'แจ้งเหตุใหม่') bg-info 
                             @elseif($incident->status == 'กำลังดำเนินการ') bg-warning 
                             @elseif($incident->status == 'เสร็จสิ้น') bg-success 
                             @elseif($incident->status == 'ยกเลิก') bg-danger 
                             @else bg-primary @endif">
                             <i class="fas fa-exclamation-triangle text-white"></i>
                         </div>
                     </div>
                     <div>
                         <div class="small text-gray-500">{{ $incident->created_at->format('F d, Y H:i') }}</div>
                         <span class="font-weight-bold">เคส: {{ $incident->case_number }} - {{ $incident->location }}</span>
                         <p class="mb-0">สถานะ: 
                             @if($incident->status == 'แจ้งเหตุใหม่')
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
        </li>
    
        <!-- User Information -->
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if ($user)
                    <span class="username">{{ $user->username }}</span>
                @endif
                <img class="img-profile rounded-circle" src="{{ asset('images/user.jpg') }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">คุณแน่ใจที่จะออกจากระบบหรือไหม?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                "เลือก 'ออกจากระบบ' ด้านล่างหากคุณพร้อมที่จะสิ้นสุดการใช้งานในครั้งนี้"</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ออกจากระบบ</button>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout.user') }}" method="POST" class="d-none">
    @csrf
</form>
