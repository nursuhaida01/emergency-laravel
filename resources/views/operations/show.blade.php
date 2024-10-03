@extends('layouts.web')

@section('content')

    <h1 class="h3 mb-2 text-gray-800">รายละเอียดข้อมูลการปฏิบัติ</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการปฏิบัติ: {{ $operation->incident->case_number ?? 'N/A' }}</h6>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 text-right"><strong>เคส:</strong></label>
                <div class="col-sm-10">
                    <p>{{ $operation->incident->case_number ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 text-right"><strong>ผู้บันทึก:</strong></label>
                <div class="col-sm-10">
                    <p>{{ $operation->user->username ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 text-right"><strong>ข้อมูลการปฏิบัติ:</strong></label>
                <div class="col-sm-10">
                    <p>{{ $operation->action_taken }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 text-right"><strong>รายละเอียด:</strong></label>
                <div class="col-sm-10">
                    <p>{{ $operation->details }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 text-right"><strong>สถานที่:</strong></label>
                <div class="col-sm-10">
                    <p>{{ $operation->location }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 text-right"><strong>วันที่:</strong></label>
                <div class="col-sm-10">
                    <p>{{ $operation->operation_date }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 text-right"><strong>รูปภาพ:</strong></label>
                <div class="col-sm-10">
                    @if ($operation->images)
                        @foreach (json_decode($operation->images) as $image)
                            <img src="{{ asset('images/' . $image) }}" alt="Image" class="img-fluid mb-2" style="max-width: 100px;">
                        @endforeach
                    @else
                        <p>ไม่มีรูปภาพ</p>
                    @endif
                </div>
            </div>

            <a href="{{ route('operations.index') }}" class="btn btn-secondary">กลับ</a>
        </div>
    </div>

@endsection
