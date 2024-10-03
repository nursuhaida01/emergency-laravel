@extends('layouts.backend')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <p>{{ $message }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


    <!-- DataTales Example -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">ข้อมูลผู้ใช้งานระบบ</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fa fa-plus"></i>
                    เพิ่มผู้ใช้
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold"> เพิ่มข้อมูล</span>
                                <span class="fw-light"> ผู้ใช้ </span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form  id="memberForm" action="{{ route('member.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 pe-0">
                                        <div class="form-group form-group-default">
                                            <label>ชื่อ-สกุล:</label>
                                            <input name="username" type="text" required class="form-control"
                                                id="username" placeholder="ชื่อสกุล"
                                                value="{{ old('username') }}" />
                                            @if ($errors->has('username'))
                                                <span class="text-danger">{{ $errors->first('username') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group form-group-default">
                                            <label>อีเมล:</label>
                                            <input name="email" type="email" required class="form-control"
                                                id="email" placeholder="อีเมล์" value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="col-md-6 pe-0">
                                        <div class="form-group form-group-default">
                                            <label>ประเภทผู้ใช้งาน:</label>
                                            <div class="col-sm-8">
                                                <select name="user_type" class="form-control" id="user_type">
                                                    <option value="ผู้ดูแลระบบ"
                                                        {{ old('user_type') == 'ผู้ดูแลระบบ' ? 'selected' : '' }}>
                                                        ผู้ดูแลระบบ</option>
                                                    <option value="พนักงาน"
                                                        {{ old('user_type') == 'พนักงาน' ? 'selected' : '' }}>พนักงาน
                                                    </option>
                                                </select>
                                                @if ($errors->has('user_type'))
                                                    <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                                @endif
                                            </div>
            
                                        </div>
                                    </div>
            
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>เบอร์โทร:</label>
                                            <input name="phone" type="tel" class="form-control" id="phone"
                                                placeholder="เบอร์โทร" value="{{ old('phone') }}" />
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="col-md-6 pe-0">
                                        <div class="form-group form-group-default">
                                            <label>รหัสผ่าน:</label>
                                            <input name="password" type="password" required class="form-control"
                                                id="password" placeholder="รหัสผ่าน" />
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
            
                                   
            
                                  
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" id="createButton" class="btn btn-primary">subimt</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover" style="width: 100%;" role="grid">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ-สกุล</th>
                            <th>อีเมล์</th>
                            <th>เบอร์โทร</th>
                            <th>ตำแหน่ง</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $member->username }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->user_type }}</td>
                                <td>
                                    <a href="{{ route('member.edit', $member->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-user-pen"></i> แก้ไข
                                    </a>
                                </td>
                                <td>
                                    @if ($member->user_type != 'admin')
                                        <!-- ป้องกันการลบ admin -->
                                        <form action="{{ route('member.destroy', $member->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('คุณต้องการลบผู้ใช้งานระบบนี้หรือไม่?')">
                                                <i class="fas fa-trash-alt"></i> ลบ
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
            <!-- เพิ่ม Pagination -->
            <div class="d-flex justify-content-center">
                {{ $members->links() }}
            </div>
        </div>
    </div>
    </div>
    <!-- DataTables script -->
    <script>
        document.getElementById('createButton').addEventListener('click', function() {
document.getElementById('memberForm').submit();
});

    </script>
@endsection


