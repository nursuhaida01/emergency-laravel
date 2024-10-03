@extends('layouts.web')

@section('title', 'Edit Incident Report')

@section('content')

<div class="container mt-5">
    <!-- แสดงข้อผิดพลาดที่นี่ -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card-header">
        <h4>แก้ไขอุบัติเหตุ</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form id="incidentForm" action="{{ route('incident.update', $incident->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3 row">
                    <label for="rate" class="col-sm-4 col-form-label text-end">พิกัด:</label>
                    <div class="col-sm-5">
                        <div class="position-relative">
                            <input type="text" name="rate" class="form-control" id="rate" value="{{ old('rate', $incident->rate) }}" required>
                            <span class="text-danger position-absolute top-50 end-0 translate-middle-y pe-2">*</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="location" class="col-sm-4 col-form-label text-right">ตำแหน่ง:</label>
                    <div class="col-sm-3">
                        <div class="position-relative">
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $incident->location) }}" required>
                            <span class="text-danger position-absolute top-50 end-0 translate-middle-y pe-2">*</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="help_needed" class="col-sm-4 col-form-label text-right">เกี่ยวกับ:</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="help_needed_1" name="help_needed" value="เจ็บป่วย" {{ old('help_needed', $incident->help_needed) == 'เจ็บป่วย' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="help_needed_1">เจ็บป่วย</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="help_needed_2" name="help_needed" value="อุบัติเหตุ" {{ old('help_needed', $incident->help_needed) == 'อุบัติเหตุ' ? 'checked' : '' }} required>
                            <label class="form-check-label" for "help_needed_2">อุบัติเหตุ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="help_needed_3" name="help_needed" value="อื่นๆ" {{ old('help_needed', $incident->help_needed) == 'อื่นๆ' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="help_needed_3">อื่นๆ</label>
                        </div>
                        
                        <!-- ฟิลด์กรอกข้อมูลที่ซ่อนไว้ -->
                        <div id="other_help_info" class="form-group row mt-3 {{ old('help_needed', $incident->help_needed) == 'อื่นๆ' ? '' : 'd-none' }}">
                            <label for="other_info" class="col-sm-4 col-form-label text-right">โปรดระบุ:</label>
                            <div class="col-sm-3">
                                <input type="text" id="other_info" name="other_info" class="form-control" value="{{ old('other_info', $incident->other_info) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="quantity" class="col-sm-4 col-form-label text-right">จำนวน:</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $incident->quantity) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-4 col-form-label text-right">รายละเอียด:</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $incident->description) }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="contact_number" class="col-sm-4 col-form-label text-right">เบอร์ติดต่อ:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number', $incident->contact_number) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="images" class="col-sm-4 col-form-label text-right">อัปโหลดรูปภาพ (ไม่บังคับ):</label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('incident.index') }}" onclick="goBack()" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
