@extends('layouts.web')

@section('content')
<section>
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">ข้อมูลการแจ้งอุบัติเหตุ </h1>
       
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการแจ้งอุบัติเหตุ</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <div style="flex: 1;">
                            <p><strong>Case No.:</strong> {{ $incident->case_number }}</p>
                            <p><strong>เวลา:</strong> {{ $incident->created_at }}</p>
                            <p><strong>พิกัด:</strong> {{ $incident->rate }}</p>
                            <p><strong>ตำแหน่ง:</strong> {{ $incident->location }}</p>
                        </div>
                        <div style="flex: 1;">
                            <p><strong>ประเภท:</strong> {{ $incident->help_needed }}</p>
                            <p><strong>จำนวน:</strong> {{ $incident->quantity }}</p>
                            <p><strong>รายละเอียด:</strong> {{ $incident->description }}</p>
                            <p><strong>เบอร์ติดต่อ:</strong> {{ $incident->contact_number }}</p>
                            <p class="card-text"><strong>สถานะ:</strong> {{ $incident->status }}</p>
        
                        </div>
                    </div>
            
                    <h5>รูปภาพที่อัปโหลด</h5>
            <div class="row">
                @if($incident->images)
                    @foreach(json_decode($incident->images) as $image)
                        <div class="col-md-4">
                            <img src="{{ asset('images/' . $image) }}" class="img-fluid" alt="รูปภาพเหตุการณ์">
                        </div>
                    @endforeach
                @else
                    <p>ไม่มีรูปภาพที่อัปโหลด</p>
                @endif
            </div>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('incident.process', $incident->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="status">สถานะ</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="">-- เลือกสถานะ --</option>
                            <option value="กำลังดำเนินการ" {{ $incident->status == 'กำลังดำเนินการ' ? 'selected' : '' }}>กำลังดำเนินการ</option>
                            <option value="เสร็จสมบูรณ์" {{ $incident->status == 'เสร็จสมบูรณ์' ? 'selected' : '' }}>เสร็จสมบูรณ์</option>
                            <option value="ยกเลิก" {{ $incident->status == 'ยกเลิก' ? 'selected' : '' }}>ยกเลิก</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="remarks">เพิ่มข้อมูลเพิ่มเติม</label>
                        <textarea id="remarks" name="remarks" class="form-control" rows="3">{{ old('remarks', $incident->remarks) }}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">บันทึกการดำเนินการ</button>
                        <a href="{{ route('incident.index') }}" class="btn btn-secondary">กลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
