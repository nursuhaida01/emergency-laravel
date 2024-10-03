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
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addNewsModal">
                    <i class="fa fa-plus"></i> เพิ่มข่าวสาร
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Modal เพิ่มข้อมูลข่าวสาร -->
            <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold"> เพิ่มข่าวสาร</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="newsForm" action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>หัวข้อข่าวสาร:</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>รายละเอียด:</label>
                                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>อัพโหลดรูปภาพ:</label>
                                            <input type="file" class="form-control" id="image" name="image[]" multiple>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>สถานที่:</label>
                                            <input type="text" class="form-control" id="location" name="location" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>หมวดหมู่:</label>
                                            <input type="text" class="form-control" id="category" name="category">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>หัวข้อข่าว</th>
                            <th>รูปภาพ</th>
                            <th>สถานที่</th>
                            <th>รายละเอียด</th>
                            <th>วันที่เผยแพร่</th>
                            <th>การกระทำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if ($item->image)
                                    @php
                                        $images = json_decode($item->image);
                                    @endphp
                                    @if ($images && count($images) > 0)
                                        <img src="{{ asset('images/' . $images[0]) }}" alt="Image" class="img-fluid" style="max-width: 90px;">
                                    @endif
                                @endif
                            </td>
                            <td>{{ $item->location }}</td>
                            <td>{{ Str::limit($item->content, 50, '...') }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline-block; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border: none; background: none; padding: 0; color: #dc3545;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
