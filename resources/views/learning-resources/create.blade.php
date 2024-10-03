@extends('layouts.backend')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">เพิ่มข้อมูลสาระเรียนรู้</h6>
    </div>
    <div class="card-body">
        <form id="learningResourceForm" action="{{ route('learning-resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ประเภทสาระเรียนรู้ -->
            <div class="form-group row mb-3">
                <label for="category" class="col-sm-4 col-form-label text-end">ประเภทสาระเรียนรู้:</label>
                <div class="col-sm-6">
                    <select name="category" class="form-control" id="category" required>
                        <option value="">เลือกประเภท</option>
                        <option value="accident" {{ old('category') == 'accident' ? 'selected' : '' }}>อุบัติเหตุ</option>
                        <option value="illness" {{ old('category') == 'illness' ? 'selected' : '' }}>เจ็บป่วย</option>
                        <option value="health" {{ old('category') == 'health' ? 'selected' : '' }}>ทั่วไป</option>
                    </select>
                </div>
            </div>

            <!-- หัวข้อ -->
            <div class="form-group row mb-3">
                <label for="title" class="col-sm-4 col-form-label text-end">หัวข้อ:</label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                </div>
            </div>

            <!-- รายละเอียด -->
            <div class="form-group row mb-3">
                <label for="description" class="col-sm-4 col-form-label text-end">รายละเอียด:</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description') }}</textarea>
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
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <a href="{{ route('learning-resources.index') }}" class="btn btn-secondary">ยกเลิก</a>
                </div>
            </div>
        </form>
        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">บันทึกข้อมูลสำเร็จ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="successMessage">
                        <!-- Success message will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">เกิดข้อผิดพลาด</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="errorMessage">
                        <!-- Error message will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#learningResourceForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#successMessage').text(response.message || 'บันทึกข้อมูลสำเร็จ');
                    $('#successModal').modal('show');
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorText = '';
                    $.each(errors, function(key, value) {
                        errorText += value[0] + '\n';
                    });
                    $('#errorMessage').text(errorText || 'เกิดข้อผิดพลาด');
                    $('#errorModal').modal('show');
                }
            });
        });
    });
</script>
@endsection
