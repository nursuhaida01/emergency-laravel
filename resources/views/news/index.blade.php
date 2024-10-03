@extends('layouts.backend')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }} <!-- แสดงข้อความสำเร็จ -->
    </div>
@endif

<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <h4 class="card-title">ข้อมูลข่าวสาร</h4>
            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fa fa-plus"></i> เพิ่มข่าวสาร
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
                            <span class="fw-mediumbold">เพิ่มข้อมูล</span>
                            <span class="fw-light">ข่าวสาร</span>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="newsForm" action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">หัวข้อข่าว</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="content">รายละเอียด</label>
                                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="time">วันที่</label>
                                <input type="date" class="form-control" id="time" name="time" required>
                            </div>
                            <div class="form-group">
                                <label for="location">สถานที่</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <div class="form-group">
                                <label for="image">รูปภาพ</label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" form="newsForm" class="btn btn-primary">บันทึก</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="newsTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>หัวข้อข่าว</th>
                        <th>วันที่</th>
                        <th>รูปภาพ</th>
                        <th>สถานที่</th>
                        <th>รายละเอียด</th>
                        <th>ลบ</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->time)->format('d/m/Y') }}</td>
                        <td>
                            @php
                                $images = json_decode($item->image);
                            @endphp
                            @if ($images && count($images) > 0)
                                <img src="{{ asset('images/' . $images[0]) }}" alt="Image" class="img-fluid" style="max-width: 90px;">
                            @endif
                        </td>
                        <td>{{ $item->location }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                            <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                <i class="fa-solid fa-user-pen"></i> แก้ไข
                            </button>
                        </td>
                        
                        <!-- Modal สำหรับแก้ไข -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">แก้ไขข่าวสาร</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm{{ $item->id }}" action="{{ route('news.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <!-- หัวข้อข่าว -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title">หัวข้อข่าว</label>
                                                        <input type="text" class="form-control" id="title" name="title" value="{{ $item->title }}" required>
                                                    </div>
                                                </div>
                                            
                                                 <!-- วันที่ -->
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="time">วันที่</label>
                                                        <input type="date" class="form-control" id="time" name="time" value="{{ $item->time }}" required>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            
                                            <div class="row">
                                                <!-- รายละเอียด -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="content">รายละเอียด</label>
                                                        <textarea class="form-control" id="content" name="content" rows="3" required>{{ $item->content }}</textarea>
                                                    </div>
                                                </div>
                                            
                                                <!-- สถานที่ -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="location">สถานที่</label>
                                                        <input type="text" class="form-control" id="location" name="location" value="{{ $item->location }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="image">รูปภาพ</label>
                                                <input type="file" class="form-control" id="image" name="image[]" multiple>
                                            
                                                @php
                                                    $images = json_decode($item->image);
                                                @endphp
                                            
                                                @if ($images && count($images) > 0)
                                                    <p>รูปภาพเดิม:</p>
                                                    <div class="row">
                                                        @foreach ($images as $image)
                                                            <div class="col-md-3 mb-2">
                                                                <img src="{{ asset('images/' . $image) }}" alt="Image" class="img-fluid" style="max-width: 100%;">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="editForm{{ $item->id }}" class="btn btn-primary">บันทึก</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
