@extends('layouts.backend')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">เพิ่มข่าวสาร</h6>
    </div>
    <div class="card-body">
        <form id="newsForm" action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ประเภทข่าวสาร -->
            <div class="form-group row mb-3">
                <label for="category" class="col-sm-4 col-form-label text-end">ประเภทข่าวสาร:</label>
                <div class="col-sm-6">
                    <select name="category" class="form-control" id="category" required>
                        <option value="">เลือกประเภทข่าวสาร</option>
                        <option value="accident" {{ old('category') == 'accident' ? 'selected' : '' }}>ข่าวอุบัติเหตุ</option>
                        <option value="illness" {{ old('category') == 'illness' ? 'selected' : '' }}>ข่าวเจ็บป่วย</option>
                        <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>ข่าวทั่วไป</option>
                    </select>
                </div>
            </div>

            <!-- หัวข้อข่าว -->
            <div class="form-group row mb-3">
                <label for="title" class="col-sm-4 col-form-label text-end">หัวข้อข่าว:</label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                </div>
            </div>

            <!-- ชื่อผู้ส่งข่าว -->
            <div class="form-group row mb-3">
                <label for="username" class="col-sm-4 col-form-label text-end">ชื่อผู้เกิดเหตุ:</label>
                <div class="col-sm-6">
                    <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
                </div>
            </div>

            <!-- ตำแหน่งที่ตั้ง -->
            <div class="form-group row mb-3">
                <label for="location" class="col-sm-4 col-form-label text-end">ตำแหน่ง:</label>
                <div class="col-sm-6">
                    <input type="text" name="location" class="form-control" id="location" value="{{ old('location') }}" required>
                </div>
            </div>

            <!-- เวลา -->
            <div class="form-group row mb-3">
                <label for="time" class="col-sm-4 col-form-label text-end">เวลา:</label>
                <div class="col-sm-6">
                    <input type="datetime-local" name="time" class="form-control" id="time" value="{{ old('time') }}" required>
                </div>
            </div>

            <!-- รายละเอียด -->
            <div class="form-group row mb-3">
                <label for="content" class="col-sm-4 col-form-label text-end">รายละเอียด:</label>
                <div class="col-sm-6">
                    <textarea name="content" class="form-control" id="content" rows="4" required>{{ old('content') }}</textarea>
                </div>
            </div>

            <!-- รูปภาพ -->
            <div class="form-group row mb-3">
                <label for="image" class="col-sm-4 col-form-label text-end">รูปภาพ:</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" id="image" name="image[]" multiple>
                </div>
            </div>

            <!-- ปุ่มส่งฟอร์ม -->
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary">อัปเดทข่าว</button>
                    <a href="#" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">บันทึกข้อมูลสำเร็จ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ข้อมูลของคุณถูกบันทึกเรียบร้อยแล้ว
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#newsForm').on('submit', function(event) {
            event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#successMessage').text(response.message);
                    $('#successModal').modal('show');
                    $('#newsForm')[0].reset(); // เคลียร์ฟอร์ม
                },
                error: function(xhr) {
                    $('#errorMessage').text('เกิดข้อผิดพลาดในการบันทึกข้อมูล');
                    $('#errorModal').modal('show');
                }
            });
        });
    });
</script>
@endsection
